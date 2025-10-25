<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
/**
 * Displays the total number of inactive companies as a Filament stats card.
 */

class InactiveCompaniesWidget extends BaseWidget
{
    protected static ?int $sort  = -10;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Unverified Companies', Company::where('isActive', false)->count())
                ->description('Unverified companies')
                ->descriptionIcon('heroicon-m-x-circle')
                ->extraAttributes([
                    'style' => 'cursor: pointer',
                    'onclick' => "window.location.href='/admin/user-list?filter=company_unverified';",
                ])
                ->color('danger'),
        ];
    }
}
