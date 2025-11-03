<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class EmployedUnemployedGenderChart extends ApexChartWidget
{
    protected static ?string $heading = 'Employed vs Unemployed Users by Gender';
    protected static ?string $chartId = 'employedUnemployedGenderChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected int | string | array $columnSpan = 2;

    protected function getOptions(): array
    {
        $genders = ['male', 'female', 'undefined'];
        $categories = ['Male', 'Female', 'Undefined'];

        $employedData = [];
        $unemployedData = [];

        foreach ($genders as $gender) {
            $employedData[] = User::whereHas('curriculumVitae')
                                  ->where('gender', $gender)
                                  ->where('employment_status', 'employed')
                                  ->count();
            $unemployedData[] = User::whereHas('curriculumVitae')
                                    ->where('gender', $gender)
                                    ->where('employment_status', 'unemployed')
                                    ->count();
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 350,
            ],
            'series' => [
                [
                    'name' => 'Employed',
                    'data' => $employedData,
                ],
                [
                    'name' => 'Unemployed',
                    'data' => $unemployedData,
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
            'colors' => ['#10B981', '#EF4444'],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'columnWidth' => '55%',
                    'endingShape' => 'rounded',
                ],
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
            'legend' => [
                'position' => 'top',
            ],
        ];
    }
}