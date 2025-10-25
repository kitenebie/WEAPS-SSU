<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
/**
 * Displays the number of users with verified emails as a Filament stats card.
 */

class VerifiedUsersWidget extends BaseWidget
{
    protected static ?int $sort  = -10;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Verified Users', User::whereNotNull('email_verified_at')->count())
                ->description('Users with verified account')
                ->descriptionIcon('heroicon-m-check-badge')
                ->extraAttributes([
                    'style' => 'cursor: pointer',
                    'onclick' => "window.location.href='/admin/user-list?filter=users_verified';",
                ])
                ->color('success'),
        ];
    }
}
