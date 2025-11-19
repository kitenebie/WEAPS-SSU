<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class EmployedUnemployedGenderChart extends ApexChartWidget
{
    protected static ?string $heading = 'Employed vs Unemployed Alumni by Gender';
    protected static ?string $chartId = 'employedUnemployedGenderChart';
    protected static ?int $contentHeight = 350;
    protected static bool $isCollapsible = true;
    protected int | string | array $columnSpan = 2;

    protected function getOptions(): array
    {
        $genders = ['male', 'female'];
        $categories = ['Male', 'Female'];

        $employedData = [];
        $unemployedData = [];
        $undefinedEmploymentData = [];

        foreach ($genders as $gender) {
            $employedData[] = User::whereHas('curriculumVitae')
                                  ->where('gender', $gender)
                                  ->where('employment_status', 'employed')
                                  ->count();
            $unemployedData[] = User::whereHas('curriculumVitae')
                                    ->where('gender', $gender)
                                    ->where('employment_status', 'unemployed')
                                    ->count();
            $undefinedEmploymentData[] = User::whereHas('curriculumVitae')
                                             ->where('gender', $gender)
                                             ->where(function ($query) {
                                                 $query->whereNull('employment_status')
                                                       ->orWhere('employment_status', '!=', 'employed')
                                                       ->where('employment_status', '!=', 'unemployed');
                                             })
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
                [
                    'name' => 'Undefined Employment',
                    'data' => $undefinedEmploymentData,
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
            'colors' => ['#FFB900', '#7F1D1D', '#494949'],
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