<?php

namespace App\Filament\Widgets;

use App\Models\Carrer;
use Carbon\Carbon;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ApplicantHiringDistributionChart extends ApexChartWidget
{
    protected static ?string $heading = 'Applicant Hiring Distribution';

    // Reactive prop passed from parent (read-only)
    public $startDate;
    public $endDate;

    // Example method to safely update the date range
    public function updateDateRange($start, $end)
    {
        $this->startDate = Carbon::parse($start);
        $this->endDate = Carbon::parse($end);

        // If you need to notify parent
        $this->emit('dateRangeUpdated', [
            'start' => $this->startDate->toDateString(),
            'end' => $this->endDate->toDateString(),
        ]);
    }

    protected function getOptions(): array
    {
        $labels = [];
        $data = [];

        $startDate = $this->startDate ?? Carbon::now()->startOfMonth();
        $endDate = $this->endDate ?? Carbon::now()->endOfMonth();

        // Example: count careers per month in range
        $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);

        foreach ($period as $date) {
            $labels[] = $date->format('M Y');
            $data[] = Carrer::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 350,
            ],
            'series' => [
                [
                    'name' => 'Jobs Posted',
                    'data' => $data,
                ],
            ],
            'xaxis' => [
                'categories' => $labels,
            ],
        ];
    }
}
