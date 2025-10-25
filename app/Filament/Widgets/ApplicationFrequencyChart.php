<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\Select;
/**
 * Analytics chart showing application frequency by users over time (yearly or all time).
 */

class ApplicationFrequencyChart extends ApexChartWidget
{
    protected static ?string $heading = 'Application Frequency Analytics';
    protected static ?string $chartId = 'applicationFrequencyChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected int | string | array $columnSpan = 2;

    protected function getFilters(): ?array
    {
        return [
            'yearly' => 'Yearly (Last 5 years)',
            'all' => 'All Time',
        ];
    }

    protected function getOptions(): array
    {
        $period = request()->query('filter', 'yearly');

        switch ($period) {
            case 'yearly':
                return $this->getYearlyData();
            case 'all':
                return $this->getAllTimeData();
            default:
                return $this->getYearlyData();
        }
    }

    private function getYearlyData(): array
    {
        $data = Applicant::select(
                'user_id',
                DB::raw('COUNT(*) as application_count'),
                DB::raw('YEAR(created_at) as year')
            )
            ->where('created_at', '>=', now()->subYears(5))
            ->groupBy('user_id', 'year')
            ->selectRaw('COUNT(*) as application_count')
            ->orderByDesc('application_count')
            ->limit(10)
            ->get()
            ->groupBy('year');

        $series = [];
        $years = [];

        // Get all unique years
        $allYears = collect();
        foreach ($data as $year => $records) {
            $allYears->push($year);
        }
        $years = $allYears->sort()->values()->toArray();

        // Prepare series data for each application count category
        $categories = ['1-2 Applications', '3-5 Applications', '6-10 Applications', '10+ Applications'];

        foreach ($categories as $category) {
            $categoryData = [];
            foreach ($years as $year) {
                $yearRecords = $data->get($year, collect());
                $count = 0;

                switch ($category) {
                    case '1-2 Applications':
                        $count = $yearRecords->whereBetween('application_count', [1, 2])->count();
                        break;
                    case '3-5 Applications':
                        $count = $yearRecords->whereBetween('application_count', [3, 5])->count();
                        break;
                    case '6-10 Applications':
                        $count = $yearRecords->whereBetween('application_count', [6, 10])->count();
                        break;
                    case '10+ Applications':
                        $count = $yearRecords->where('application_count', '>', 10)->count();
                        break;
                }

                $categoryData[] = $count;
            }

            $series[] = [
                'name' => $category,
                'data' => $categoryData,
            ];
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 350,
                'stacked' => true,
            ],
            'series' => $series,
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
            'colors' => ['#3B82F6', '#10B981', '#F59E0B', '#EF4444'],
            'legend' => [
                'position' => 'top',
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
        ];
    }

    private function getAllTimeData(): array
    {
        $data = Applicant::select(
                'user_id',
                DB::raw('COUNT(*) as application_count')
            )
            ->groupBy('user_id')
            ->selectRaw('COUNT(*) as application_count')
            ->orderByDesc('application_count')
            ->limit(15)
            ->get();

        $categories = [];
        $counts = [];

        foreach ($data as $record) {
            $categories[] = 'User ' . $record->user_id;
            $counts[] = $record->application_count;
        }

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 350,
            ],
            'series' => $counts,
            'labels' => $categories,
            'colors' => [
                '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
                '#EC4899', '#06B6D4', '#84CC16', '#F97316', '#6366F1',
                '#14B8A6', '#F43F5E', '#8B5CF6', '#06B6D4', '#84CC16'
            ],
            'legend' => [
                'position' => 'bottom',
            ],
            'dataLabels' => [
                'enabled' => true,
                'formatter' => 'function (val) { return val.toFixed(1) + "%" }',
            ],
        ];
    }
}
