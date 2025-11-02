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
    protected int | string | array $columnSpan = 1;

    protected function getOptions(): array
    {
        $employed = User::where('employment_status', 'employed')->count();
        $unemployed = User::where(function ($query) {
            $query->where('employment_status', 'unemployed')
                  ->orWhereNull('employment_status');
        })->count();

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 350,
            ],
            'series' => [$employed, $unemployed],
            'labels' => ['Employed', 'Unemployed'],
            'colors' => ['#10B981', '#EF4444'],
            'legend' => [
                'position' => 'bottom',
            ],
        ];
    }
}