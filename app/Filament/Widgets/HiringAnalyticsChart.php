<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\Select;
/**
 * Charts visualizing hiring counts over time (monthly/yearly) and overall total.
 */

class HiringAnalyticsChart extends ApexChartWidget
{
    protected static ?string $heading = 'Hiring Analytics';
    protected static ?string $chartId = 'hiringAnalyticsChart';
    protected static ?int $contentHeight = 300;
    protected static bool $isCollapsible = true;
    protected int | string | array $columnSpan = 2;

    protected function getFilters(): ?array
    {
        return [
            'monthly' => 'Monthly (Last 12 months)',
            'yearly' => 'Yearly (Last 5 years)',
            'all' => 'All Time',
        ];
    }

    protected function getOptions(): array
    {
        $period = request()->query('filter', 'monthly');

        switch ($period) {
            case 'monthly':
                return $this->getMonthlyData();
            case 'yearly':
                return $this->getYearlyData();
            case 'all':
                return $this->getAllTimeData();
            default:
                return $this->getMonthlyData();
        }
    }

    private function getMonthlyData(): array
    {
        $data = Applicant::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $months = [];
        $counts = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $months[] = now()->subMonths($i)->format('M Y');
            $counts[] = $data->get($month, 0);
        }

        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Hiring Count',
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
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#FFB900'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }

    private function getYearlyData(): array
    {
        $data = Applicant::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subYears(5))
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('count', 'year');

        $years = [];
        $counts = [];

        for ($i = 4; $i >= 0; $i--) {
            $year = now()->subYears($i)->format('Y');
            $years[] = $year;
            $counts[] = $data->get((int)$year, 0);
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Hiring Count',
                    'data' => $counts,
                ],
            ],
            'xaxis' => [
                'categories' => $years,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#7F1D1D'],
        ];
    }

    private function getAllTimeData(): array
    {
        $totalHirings = Applicant::count();

        return [
            'chart' => [
                'type' => 'radialBar',
                'height' => 300,
            ],
            'series' => [$totalHirings > 0 ? min($totalHirings, 100) : 0],
            'labels' => ['Total Hirings'],
            'colors' => ['#494949'],
            'plotOptions' => [
                'radialBar' => [
                    'hollow' => [
                        'size' => '70%',
                    ],
                    'dataLabels' => [
                        'value' => [
                            'formatter' => 'function (val) { return val + " hirings" }',
                        ],
                    ],
                ],
            ],
        ];
    }
}
