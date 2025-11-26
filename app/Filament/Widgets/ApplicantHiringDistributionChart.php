<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;
use Livewire\Attributes\Reactive;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

class ApplicantHiringDistributionChart extends ApexChartWidget
{
    use HasFiltersSchema;

    protected static ?string $heading = 'Company Career Posts Distribution';
    protected static ?string $chartId = 'companyCareerPostsChart';
    protected static ?int $contentHeight = 350;

    protected ?string $pollingInterval = '1s';
    protected static bool $isCollapsible = true;
    protected int|string|array $columnSpan = 2;

    #[Reactive]
    public ?int $company_id = null;

    #[Reactive]
    public ?Carbon $startDate = null;

    #[Reactive]
    public ?Carbon $endDate = null;

    /**
     * Define the chart filters schema
     */
    public function filtersSchema($schema)
    {
        return $schema->components([
            Select::make('company_id')
                ->label('Select Company')
                ->searchable()
                ->options([null => 'All Companies'] + Company::orderBy('name')->pluck('name', 'id')->toArray())
                ->placeholder('All Companies'),

            DatePicker::make('startDate')
                ->label('From Date')
                ->default(now()->subMonths(12)),

            DatePicker::make('endDate')
                ->label('To Date')
                ->default(now()),
        ]);
    }

    /**
     * Optional action to manually refresh chart
     */
    public function mountAction()
    {
        $this->dispatch('$refresh');
    }

    /**
     * Generate chart options
     */
    protected function getOptions(): array
    {
        $start = ($this->startDate ?? now()->subMonths(12))->toImmutable();
        $end = ($this->endDate ?? now())->toImmutable();

        // Generate months for x-axis
        $period = CarbonPeriod::create($start, '1 month', $end);
        $months = [];
        foreach ($period as $date) {
            $months[] = $date->format('F Y');
        }

        // Query companies
        $companiesQuery = Company::query();
        if ($this->company_id) {
            $companiesQuery->where('id', $this->company_id);
        }
        $companies = $companiesQuery->get();

        // Build series for chart
        $series = $companies->map(function ($company) use ($period) {
            $monthlyData = [];
            foreach ($period as $date) {
                $monthlyData[] = $company->careers()
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
            }

            return [
                'name' => $company->name,
                'data' => $monthlyData,
            ];
        })->toArray();

        // Chart options
        return [
            'chart' => ['type' => 'bar', 'height' => 350],
            'series' => $series,
            'xaxis' => [
                'categories' => $months,
                'labels' => ['style' => ['fontFamily' => 'inherit']]
            ],
            'yaxis' => [
                'title' => ['text' => 'Quantity'],
                'labels' => ['style' => ['fontFamily' => 'inherit']]
            ],
            'colors' => ['#4FA753', '#2992E3', '#494949', '#7F1D1D'],
            'plotOptions' => ['bar' => ['distributed' => true]],
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
