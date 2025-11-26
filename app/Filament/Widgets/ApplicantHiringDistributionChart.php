<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;
use Carbon\CarbonPeriod;
use Livewire\Attributes\Reactive;

class ApplicantHiringDistributionChart extends ApexChartWidget
{
    use HasFiltersSchema;

    protected static ?string $heading = 'Company Career Posts Distribution';
    protected static ?string $chartId = 'companyCareerPostsChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected int | string | array $columnSpan = 2;

    #[Reactive]
    public ?int $company_id = null;

    #[Reactive]
    public ?string $startDate = null;

    #[Reactive]
    public ?string $endDate = null;

    public function filtersSchema(Schema $schema): Schema
    {
        return $schema->components([

            Select::make('company_id')
                ->label('Select Company')
                ->options([null => 'All Companies'] + Company::orderBy('name')->pluck('name', 'id')->toArray())
                ->searchable()
                ->placeholder('All Companies')
                ->afterStateUpdated(fn ($state) => $this->company_id = $state),

            DatePicker::make('startDate')
                ->label('From Date')
                ->default(now()->subMonths(12)->toDateString())
                ->afterStateUpdated(fn ($state) => $this->startDate = $state),

            DatePicker::make('endDate')
                ->label('To Date')
                ->default(now()->toDateString())
                ->afterStateUpdated(fn ($state) => $this->endDate = $state),

            Action::make('applyFilter')
                ->label('Apply Filter')
                ->color('primary')
                ->action(fn () => $this->dispatch('$refresh')),
        ]);
    }

    protected function getOptions(): array
    {
        return $this->getData($this->company_id, $this->startDate, $this->endDate);
    }

    private function getData($companyId, $startDate, $endDate): array
    {
        $startDate = $startDate ?? now()->subMonths(12)->format('Y-m-d');
        $endDate = $endDate ?? now()->format('Y-m-d');

        // Build fresh period for categories
        $period = CarbonPeriod::create($startDate, '1 month', $endDate);
        $months = [];
        foreach ($period as $date) {
            $months[] = $date->format('F Y');
        }

        $companiesQuery = Company::query();
        if ($companyId) {
            $companiesQuery->where('id', $companyId);
        }
        $companies = $companiesQuery->get();

        $series = [];

        foreach ($companies as $company) {

            // ⚠️ Must recreate period to avoid exhausted generator
            $periodLoop = CarbonPeriod::create($startDate, '1 month', $endDate);

            $monthlyData = [];
            foreach ($periodLoop as $date) {
                $monthlyData[] = $company->careers()
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
            }

            $series[] = [
                'name' => $company->name,
                'data' => $monthlyData,
            ];
        }

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
        ];
    }
}
