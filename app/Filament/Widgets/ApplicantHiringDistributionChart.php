<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Actions;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ApplicantHiringDistributionChart extends ApexChartWidget
{
    use HasFiltersSchema;

    protected static ?string $heading = 'Company Career Posts Distribution';
    protected static ?string $chartId = 'companyCareerPostsChart';
    protected static ?int $contentHeight = 350;

    protected ?string $pollingInterval = '1s';
    protected static bool $isCollapsible = true;
    protected int|string|array $columnSpan = 2;

    public ?int $company_id = null;

    public ?CarbonInterface $startDate = null;

    public ?CarbonInterface $endDate = null;

    public function mount(): void
    {
        parent::mount();

        if (blank($this->filters)) {
            $this->filters = $this->getDefaultFiltersState();
        }

        $this->applyFilters(shouldRefresh: false);
    }

    /**
     * Define the chart filters schema
     */
    public function filtersSchema($schema)
    {
        return $schema->components([
            Select::make('company_id')
                ->label('Select Company')
                ->searchable()
                ->preload()
                ->nullable()
                ->options(Company::orderBy('name')->pluck('name', 'id')->toArray())
                ->placeholder('All Companies'),

            DatePicker::make('startDate')
                ->label('From Date')
                ->maxDate(fn () => data_get($this->filters, 'endDate'))
                ->default($this->getDefaultFiltersState()['startDate'])
                ->native(false),

            DatePicker::make('endDate')
                ->label('To Date')
                ->minDate(fn () => data_get($this->filters, 'startDate'))
                ->default($this->getDefaultFiltersState()['endDate'])
                ->native(false),

            Actions::make([
                Action::make('applyFilters')
                    ->label('Apply')
                    ->action('applyFilters')
                    ->icon('heroicon-o-funnel')
                    ->color('primary'),
                Action::make('resetFilters')
                    ->label('Reset')
                    ->color('danger')
                    ->action('resetFilters')
                    ->icon('heroicon-o-arrow-path'),
            ])->fullWidth(),
        ]);
    }

    /**
     * Optional action to manually refresh chart
     */
    public function mountAction()
    {
        $this->dispatch('$refresh');
    }

    public function applyFilters(bool $shouldRefresh = true): void
    {
        $filters = $this->filters ?? [];

        $start = $this->resolveDate(data_get($filters, 'startDate'), true)
            ?? CarbonImmutable::now()->subMonths(12)->startOfDay();
        $end = $this->resolveDate(data_get($filters, 'endDate'), false)
            ?? CarbonImmutable::now()->endOfDay();

        if ($start->greaterThan($end)) {
            [$start, $end] = [$end->startOfDay(), $start->endOfDay()];
        }

        $this->company_id = filled($filters['company_id'] ?? null)
            ? (int) $filters['company_id']
            : null;

        $this->startDate = $start;
        $this->endDate = $end;

        if ($shouldRefresh) {
            $this->dispatch('$refresh');
        }
    }

    public function resetFilters(): void
    {
        $this->filters = $this->getDefaultFiltersState();
        $this->applyFilters();
    }

    protected function getDefaultFiltersState(): array
    {
        return [
            'company_id' => null,
            'startDate' => CarbonImmutable::now()->subMonths(12)->toDateString(),
            'endDate' => CarbonImmutable::now()->toDateString(),
        ];
    }

    protected function resolveDate(null|string|CarbonInterface $value, bool $isStart): ?CarbonImmutable
    {
        if (blank($value)) {
            return null;
        }

        $date = CarbonImmutable::parse($value);

        return $isStart ? $date->startOfDay() : $date->endOfDay();
    }

    /**
     * Generate chart options
     */
    protected function getOptions(): array
    {
        $rangeStart = ($this->startDate ?? CarbonImmutable::now()->subMonths(12)->startOfDay());
        $rangeEnd = ($this->endDate ?? CarbonImmutable::now()->endOfDay());

        $timeline = collect(CarbonPeriod::create(
            $rangeStart->startOfMonth(),
            '1 month',
            $rangeEnd->startOfMonth()
        ))->values();

        if ($timeline->isEmpty()) {
            $timeline = collect([CarbonImmutable::now()->startOfMonth()]);
        }

        $monthBuckets = [];
        $monthLabels = [];
        foreach ($timeline as $date) {
            $key = $date->format('Y-m');
            $monthBuckets[$key] = $date;
            $monthLabels[$key] = $date->translatedFormat('F Y');
        }

        $monthTotals = array_fill_keys(array_keys($monthBuckets), 0);

        // Query companies
        $companies = Company::query()
            ->when($this->company_id, fn ($query) => $query->where('id', $this->company_id))
            ->get();

        $rawSeries = [];

        // Build series data per company while accumulating monthly totals
        foreach ($companies as $company) {
            $dataByMonth = [];

            foreach ($monthBuckets as $key => $date) {
                $count = $company->careers()
                    ->whereBetween('created_at', [$rangeStart, $rangeEnd])
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();

                $dataByMonth[$key] = $count;
                $monthTotals[$key] += $count;
            }

            $rawSeries[] = [
                'name' => $company->name,
                'data' => $dataByMonth,
            ];
        }

        arsort($monthTotals);

        $sortedMonthKeys = [];
        foreach ($monthTotals as $key => $total) {
            if ($total >= 1) {
                $sortedMonthKeys[] = $key;
            }
        }

        $months = array_map(fn (string $key) => $monthLabels[$key], $sortedMonthKeys);

        $series = array_map(function (array $entry) use ($sortedMonthKeys) {
            $orderedData = [];
            foreach ($sortedMonthKeys as $monthKey) {
                $orderedData[] = $entry['data'][$monthKey] ?? 0;
            }

            return [
                'name' => $entry['name'],
                'data' => $orderedData,
            ];
        }, $rawSeries);

        // Chart options
        return [
            'chart' => ['type' => 'bar', 'height' => 350],
            'series' => $series,
            'xaxis' => [
                'categories' => $months,
                'labels' => ['style' => ['fontFamily' => 'inherit']]
            ],
            // 'yaxis' => [
            //     'title' => ['text' => 'Quantity'],
            //     'labels' => ['style' => ['fontFamily' => 'inherit']]
            // ],
            'colors' => ['#4FA753', '#2992E3', '#494949', '#7F1D1D'],
            'plotOptions' => [
                'bar' => [
                    'distributed' => true,
                    'horizontal' => true,
                    'barHeight' => '70%',
                ],
            ],
            'legend' => ['position' => 'top'],
            'dataLabels' => ['enabled' => false],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
