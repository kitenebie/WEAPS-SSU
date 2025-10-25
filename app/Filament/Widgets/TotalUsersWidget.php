<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
/**
 * Displays the total number of registered users as a Filament stats card.
 */

class TotalUsersWidget extends BaseWidget
{
    protected static ?int $sort  = -10;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-users')
                ->extraAttributes([
                    'style' => 'cursor: pointer',
                    'onclick' => "window.location.href='/admin/user-list?filter=users_list';",
                ])
                ->color('primary'),
        ];
    }
}
