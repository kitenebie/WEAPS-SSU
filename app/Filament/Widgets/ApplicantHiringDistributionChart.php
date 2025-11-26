<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Widgets\ChartWidget\Concerns\HasFiltersSchema;

class ApplicantHiringDistributionChart extends ApexChartWidget
{
    use HasFiltersSchema;

    protected static ?string $heading = 'Company Career Posts Distribution';
    protected static ?string $chartId = 'companyCareerPostsChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected static bool $Collapse = false;
    protected int | string | array $columnSpan = 2;

    // Public properties for filters
    public ?int $company_id = null;
    public ?string $startDate = null;
    public ?string $endDate = null;

    public function filtersSchema(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('company_id')
                ->label('Select Company')
                ->options(Company::orderBy('name')->pluck('name', 'id')->toArray())
                ->placeholder('All Companies')
                ->reactive()
                ->dehydrateStateUsing(fn($state) => $this->company_id = $state),

            DatePicker::make('startDate')
                ->label('From Date')
                ->default(now()->subMonths(12))
                ->reactive()
                ->dehydrateStateUsing(fn($state) => $this->startDate = $state),

            DatePicker::make('endDate')
                ->label('To Date')
                ->default(now())
                ->reactive()
                ->dehydrateStateUsing(fn($state) => $this->endDate = $state),
        ]);
    }

    protected function getOptions(): array
    {
        return $this->getData($this->company_id, $this->startDate, $this->endDate);
    }

    private function getData($companyId = null, $startDate = null, $endDate = null): array
    {
        // Default dates if not set
        $startDate = $startDate ?? now()->subMonths(12)->format('Y-m-d');
        $endDate = $endDate ?? now()->format('Y-m-d');

        // Prepare months for X-axis
        $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);
        $months = [];
        foreach ($period as $date) {
            $months[] = $date->format('F Y');
        }

        // Query companies
        $companiesQuery = Company::query();
        if ($companyId) {
            $companiesQuery->where('id', $companyId);
        }
        $companies = $companiesQuery->get();

        $series = [];

        foreach ($companies as $company) {
            $monthlyData = [];
            foreach ($period as $date) {
                $monthlyCount = $company->careers()
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
                $monthlyData[] = $monthlyCount;
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
                'labels' => ['style' => ['fontFamily' => 'inherit']],
            ],
            'yaxis' => [
                'title' => ['text' => 'Quantity'],
                'labels' => ['style' => ['fontFamily' => 'inherit']],
            ],
            'colors' => ['#4FA753', '#2992E3', '#494949', '#7F1D1D'],
            'plotOptions' => ['bar' => ['distributed' => true]],
            'legend' => ['position' => 'top'],
            'dataLabels' => ['enabled' => false],
        ];
    }
}
