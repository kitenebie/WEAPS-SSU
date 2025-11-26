<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
/**
 * Analytics chart showing application counts by month-year and status.
 */

class ApplicationFrequencyChart extends ApexChartWidget
{
    protected static ?string $heading = 'Application Frequency by Year and Status';
    protected static ?string $chartId = 'applicationFrequencyByMonthYearChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected static bool $Collapse = false;
    protected int | string | array $columnSpan = 2;

    protected function getFilters(): ?array
    {
        // Get unique years from applicants
        $years = Applicant::distinct()
            ->pluck(DB::raw('YEAR(created_at) as year'))
            ->sort()
            ->toArray();

        $yearFilters = [];
        foreach ($years as $year) {
            $yearFilters[$year] = $year;
        }

        return $yearFilters;
    }

    protected function getOptions(): array
    {
        $year = request()->query('filter', 2025);
        return $this->getDataForYearAndMonth($year, 'all');
    }

    private function getDataForYearAndMonth($year, $month): array
    {
        $query = Applicant::select(
            DB::raw('MONTH(created_at) as month'),
            'status',
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', $year)
        ->groupBy('month', 'status')
        ->get();

        $statuses = ['pending', 'approved', 'rejected'];
        $monthNames = [
            1 => 'JAN', 2 => 'FEB', 3 => 'MAR', 4 => 'APR', 5 => 'MAY', 6 => 'JUN',
            7 => 'JUL', 8 => 'AUG', 9 => 'SEP', 10 => 'OCT', 11 => 'NOV', 12 => 'DEC'
        ];

        $categories = array_values($monthNames);

        $series = [];
        foreach ($statuses as $status) {
            $statusData = [];
            foreach ($categories as $cat) {
                $monthNum = array_search($cat, $monthNames);
                $count = $query->where('month', $monthNum)->where('status', $status)->sum('count');
                $statusData[] = $count;
            }
            $series[] = [
                'name' => ucfirst($status),
                'data' => $statusData,
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
                'categories' => $categories,
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
            'colors' => ['#1E1E1E', '#4FA753', '#7F1D1D'],
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
        // Use current year and all months
        $currentYear = date('Y');
        return $this->getDataForYearAndMonth($currentYear, 'all');
    }
}
