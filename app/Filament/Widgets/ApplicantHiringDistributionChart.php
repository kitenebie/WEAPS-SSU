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
                ->searchable()
                ->options([null => 'All Companies'] + Company::orderBy('name')->pluck('name', 'id')->toArray())
                ->placeholder('All Companies')
                ->reactive(),

            DatePicker::make('startDate')
                ->label('From Date')
                ->default(now()->subMonths(12))
                ->reactive(),

            DatePicker::make('endDate')
                ->label('To Date')
                ->default(now())
                ->reactive(),
        ]);
    }

    protected function getOptions(): array
    {
        return $this->getData(
            $this->company_id,
            $this->startDate,
            $this->endDate
        );
    }


    private function getData($companyId = null, $startDate = null, $endDate = null): array
    {
        $startDate = $startDate ?? now()->subMonths(12)->format('Y-m-d');
        $endDate   = $endDate   ?? now()->format('Y-m-d');

        $period = CarbonPeriod::create($startDate, '1 month', $endDate);

        // Get months for X-axis
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

            // rebuild period because it gets consumed by the loop
            $period = CarbonPeriod::create($startDate, '1 month', $endDate);

            $monthlyData = [];
            foreach ($period as $date) {
                $monthlyData[] = $company->careers()
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
            }

            $series[] = [
                'name'  => $company->name,
                'data'  => $monthlyData,
            ];
        }

        return [
            'chart' => ['type' => 'bar', 'height' => 350],
            'series' => $series,
            'xaxis' => ['categories' => $months],
        ];
    }
}
