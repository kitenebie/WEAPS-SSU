<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Filament\Forms\Components\Select;

class ApplicantHiringDistributionChart extends ApexChartWidget
{
    protected static ?string $heading = 'Applicant Hiring Distribution';
    protected static ?string $chartId = 'applicantHiringDistributionChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected static bool $Collapse = false;

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
                DB::raw('COUNT(*) as hiring_count'),
                DB::raw('YEAR(created_at) as year')
            )
            ->where('created_at', '>=', now()->subYears(5))
            ->groupBy('user_id', 'year')
            ->selectRaw('COUNT(*) as hiring_count')
            ->orderByDesc('hiring_count')
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

        // Prepare series data for each hiring count category
        $categories = ['1 Hiring', '2-3 Hirings', '4-5 Hirings', '6+ Hirings'];

        foreach ($categories as $category) {
            $categoryData = [];
            foreach ($years as $year) {
                $yearRecords = $data->get($year, collect());
                $count = 0;

                switch ($category) {
                    case '1 Hiring':
                        $count = $yearRecords->where('hiring_count', 1)->count();
                        break;
                    case '2-3 Hirings':
                        $count = $yearRecords->whereBetween('hiring_count', [2, 3])->count();
                        break;
                    case '4-5 Hirings':
                        $count = $yearRecords->whereBetween('hiring_count', [4, 5])->count();
                        break;
                    case '6+ Hirings':
                        $count = $yearRecords->where('hiring_count', '>', 5)->count();
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
            'colors' => ['#10B981', '#3B82F6', '#F59E0B', '#EF4444'],
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
                DB::raw('COUNT(*) as hiring_count')
            )
            ->groupBy('user_id')
            ->selectRaw('COUNT(*) as hiring_count')
            ->orderByDesc('hiring_count')
            ->limit(10)
            ->get();

        $categories = [];
        $counts = [];

        foreach ($data as $record) {
            $categories[] = 'User ' . $record->user_id;
            $counts[] = $record->hiring_count;
        }

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 350,
            ],
            'series' => $counts,
            'labels' => $categories,
            'colors' => ['#10B981', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899', '#06B6D4', '#84CC16'],
            'legend' => [
                'position' => 'bottom',
            ],
        ];
    }
}