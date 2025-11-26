<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\TextInput;

class ApplicantHiringDistributionChart extends ApexChartWidget
{
    protected static ?string $heading = 'Company Career Posts Distribution';
    protected static ?string $chartId = 'companyCareerPostsChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected static bool $Collapse = false;
    protected int | string | array $columnSpan = 2;

    // Add property for search input
    public ?string $search = null;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('search')
                ->label('Search Company')
                ->placeholder('Type company name...')
                ->reactive() // triggers chart refresh on typing
        ];
    }

    protected function getFilters(): ?array
    {
        $years = DB::table('carrers')
            ->select(DB::raw('DISTINCT YEAR(created_at) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $filters = ['All' => 'All'];
        foreach ($years as $year) {
            $filters[$year] = $year;
        }
        return $filters;
    }

    protected function getOptions(): array
    {
        $year = request()->query('filter', 'All');
        return $this->getDataForYear($year, $this->search);
    }

    private function getDataForYear($year, $search = null): array
    {
        $months = collect(range(1, 12))->map(fn($m) => date('F', mktime(0, 0, 0, $m, 1)))->toArray();

        $query = Company::query();
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $companies = $query->get();
        $series = [];

        foreach ($companies as $company) {
            $monthlyData = [];
            for ($m = 1; $m <= 12; $m++) {
                $monthlyCount = $company->careers()
                    ->when($year !== 'All', fn($q) => $q->whereYear('created_at', $year))
                    ->whereMonth('created_at', $m)
                    ->count();
                $monthlyData[] = $monthlyCount;
            }
            $series[] = [
                'name' => $company->name,
                'data' => $monthlyData,
            ];
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 350,
            ],
            'series' => $series,
            'xaxis' => [
                'categories' => $months,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'title' => ['text' => 'Quantity'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#4FA753', '#2992E3', '#494949', '#7F1D1D'],
            'plotOptions' => [
                'bar' => [
                    'distributed' => true,
                ],
            ],
            'legend' => [
                'position' => 'top',
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
        ];
    }
}
