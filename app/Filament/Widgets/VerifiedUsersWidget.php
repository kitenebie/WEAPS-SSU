<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VerifiedUsersWidget extends BaseWidget
{
    protected static ?int $sort  = -10;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Verified Users', User::whereNotNull('email_verified_at')->count())
                ->description('Users with verified emails')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}