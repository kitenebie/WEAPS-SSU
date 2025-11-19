<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
/**
 * Bar chart showing company names ordered from least to highest career posts since 2025.
 */

class ApplicantHiringDistributionChart extends ApexChartWidget
{
    protected static ?string $heading = 'Company Career Posts Distribution (2025+)';
    protected static ?string $chartId = 'companyCareerPostsChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected static bool $Collapse = false;
    protected int | string | array $columnSpan = 2;

    protected function getFilters(): ?array
    {
        $years = DB::table('carrers')
            ->join('companies', 'carrers.company_id', '=', 'companies.id')
            ->where('carrers.created_at', '>=', '2025-01-01')
            ->distinct()
            ->pluck(DB::raw('YEAR(carrers.created_at) as year'))
            ->sort()
            ->toArray();

        $filters = [];
        foreach ($years as $year) {
            $filters[$year] = $year;
        }
        return $filters;
    }

    protected function getOptions(): array
    {
        $year = request()->query('filter', 2025);
        return $this->getDataForYear($year);
    }

    private function getDataForYear($year): array
    {
        $data = Company::withCount(['careers' => function ($query) use ($year) {
            $query->whereYear('created_at', $year);
        }])
        ->orderBy('careers_count')
        ->get();

        $categories = [];
        $counts = [];

        foreach ($data as $company) {
            $categories[] = $company->name;
            $counts[] = $company->careers_count;
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 350,
            ],
            'series' => [
                [
                    'name' => 'Career Posts in ' . $year,
                    'data' => $counts,
                ],
            ],
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
            'colors' => ['#4FA753', '#2992E3', '#494949', '#7F1D1D', '#4FA753', '#2992E3', '#494949', '#7F1D1D', '#4FA753', '#2992E3', '#494949', '#7F1D1D',],
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

    private function getAllTimeData(): array
    {
        // Fallback to 2025 data
        return $this->getDataForYear(2025);
    }
}
