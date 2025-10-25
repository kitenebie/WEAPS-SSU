<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
/**
 * Displays the total number of registered companies as a Filament stats card.
 */

class TotalCompaniesWidget extends BaseWidget
{
    protected static ?int $sort  = -10;
    protected int | string | array $columnSpan = ['sm' => 'full', 'md' => 1, 'lg' => 1];

    protected function getStats(): array
    {
        return [
            Stat::make('Total Companies', Company::count())
                ->description('All registered companies')
                ->descriptionIcon('heroicon-m-building-office')
                ->extraAttributes([
                    'style' => 'cursor: pointer',
                    'onclick' => "window.location.href='/admin/user-list?filter=company_list';",
                ])
                ->color('primary'),
        ];
    }
}
