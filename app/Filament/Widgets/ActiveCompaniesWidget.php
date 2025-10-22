<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActiveCompaniesWidget extends BaseWidget
{
    protected static ?int $sort  = -10;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Active Companies', Company::where('isActive', true)->count())
                ->description('Currently active companies')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}