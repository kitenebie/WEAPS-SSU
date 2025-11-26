<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class EmployedUnemployedChart extends ApexChartWidget
{
    protected static ?string $heading = 'Employed vs Unemployed Alumni';
    protected static ?string $chartId = 'employedUnemployedChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected static bool $Collapse = false;
    protected int | string | array $columnSpan = 2;

    protected function getOptions(): array
    {
        $employed = User::whereHas('curriculumVitae')
                        ->where('employment_status', 'employed')
                        ->count();
        $unemployed = User::whereHas('curriculumVitae')
                          ->where(function ($query) {
                              $query->where('employment_status', 'unemployed')
                                    ->orWhereNull('employment_status');
                          })->count();
        // $undefined = User::whereHas('curriculumVitae')
        //                  ->where('employment_status', 'undefined')
        //                  ->count();

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 350,
            ],
            'series' => [$employed, $unemployed],
            // 'series' => [$employed, $unemployed, $undefined],
            'labels' => ['Employed', 'Unemployed'],
            'colors' => ['#7F1D1D', '#1E1E1E'],
            // 'colors' => ['#7F1D1D', '#1E1E1E', '#494949'],
            'legend' => [
                'position' => 'bottom',
            ],
        ];
    }
}