<?php

namespace App\Filament\Widgets;

use App\Models\Carrer;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\TextInput;

class CareerPostsChart extends ApexChartWidget
{
    protected static ?string $heading = 'Career Posts Analytics';
    protected static ?string $chartId = 'careerPostsChart';
    protected static ?int $contentHeight = 300;
    protected static bool $isCollapsible = true;
    protected static bool $Collapse = false;
    protected int | string | array $columnSpan = 2;

    // Add search input
    public ?string $companySearch = null;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('companySearch')
                ->label('Search Company')
                ->placeholder('Enter company name')
                ->reactive(),
        ];
    }

    protected function getFilters(): ?array
    {
        $years = Carrer::select(DB::raw('YEAR(created_at) as year'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        $filter = ['all' => 'All Time'];

        foreach ($years as $year) {
            $filter[$year] = $year;
        }

        return $filter;
    }

    protected function getOptions(): array
    {
        $period = request()->query('filter', 'all');

        switch ($period) {
            case 'all':
                return $this->getAllTimeData();
            default:
                return $this->getYearlyOrMonthlyData($period);
        }
    }

    private function getYearlyOrMonthlyData($year): array
    {
        $query = Carrer::query();

        if ($year !== 'all') {
            $query->whereYear('created_at', $year);
        }

        if ($this->companySearch) {
            $query->where('company_name', 'like', "%{$this->companySearch}%");
        }

        // Group by month
        $data = $query->select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        $months = [];
        $counts = [];
        for ($i = 0; $i < 12; $i++) {
            $month = now()->subMonths(11 - $i)->format('Y-m');
            $months[] = now()->subMonths(11 - $i)->format('M Y');
            $counts[] = $data->get($month, 0);
        }

        return [
            'chart' => [
                'type' => 'area',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Quantity',
                    'data' => $counts,
                ],
            ],
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
            'colors' => ['#3C3C3C'],
            'stroke' => ['curve' => 'smooth'],
            'fill' => ['opacity' => 0.3],
        ];
    }

    private function getAllTimeData(): array
    {
        $totalPosts = Carrer::when($this->companySearch, function ($q) {
            $q->where('company_name', 'like', "%{$this->companySearch}%");
        })->count();

        return [
            'chart' => [
                'type' => 'radialBar',
                'height' => 300,
            ],
            'series' => [$totalPosts > 0 ? min($totalPosts, 100) : 0],
            'labels' => ['Total Career Posts'],
            'colors' => ['#1E1E1E'],
            'plotOptions' => [
                'radialBar' => [
                    'hollow' => ['size' => '70%'],
                    'dataLabels' => [
                        'value' => [
                            'formatter' => 'function (val) { return val + " posts"; }',
                        ],
                    ],
                ],
            ],
        ];
    }
}
