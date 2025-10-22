<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalCompaniesWidget extends BaseWidget
{
    protected static ?int $sort  = -10;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Companies', Company::count())
                ->description('All registered companies')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('primary'),
        ];
    }
}