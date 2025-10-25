<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
/**
 * Displays the number of users pending email verification as a Filament stats card.
 */

class UnverifiedUsersWidget extends BaseWidget
{
    protected static ?int $sort  = -10;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Unverified Users', User::whereNull('email_verified_at')->count())
                ->description('Users pending verification')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->extraAttributes([
                    'style' => 'cursor: pointer',
                    'onclick' => "window.location.href='/admin/user-list?filter=users_unverified';",
                ])
                ->color('warning'),
        ];
    }
}
