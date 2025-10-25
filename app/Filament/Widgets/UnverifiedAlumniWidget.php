<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Displays the number of unverified alumni as a Filament stats card.
 */

class UnverifiedAlumniWidget extends BaseWidget
{
    protected static ?int $sort = -10;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Unverified Alumni', User::whereHas('curriculumVitae')->whereNull('email_verified_at')->count())
                ->description('Alumni with unverified emails')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning'),
        ];
    }
}