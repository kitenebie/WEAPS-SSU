<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class EmployedUnemployedChart extends ApexChartWidget
{
    protected static ?string $heading = 'Employed vs Unemployed Users';
    protected static ?string $chartId = 'employedUnemployedChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected int | string | array $columnSpan = 2;

    protected function getOptions(): array
    {
        $employed = User::where('employment_status', 'employed')->count();
        $unemployed = User::where(function ($query) {
            $query->where('employment_status', 'unemployed')
                  ->orWhereNull('employment_status');
        })->count();
        $undefined = User::where('employment_status', 'undefined')->count();

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 350,
            ],
            'series' => [$employed, $unemployed, $undefined],
            'labels' => ['Employed', 'Unemployed', 'Undefined'],
            'colors' => ['#10B981', '#EF4444', '#9110B9FF'],
            'legend' => [
                'position' => 'bottom',
            ],
        ];
    }
}