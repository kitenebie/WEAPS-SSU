<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

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
                ->color('warning'),
        ];
    }
}