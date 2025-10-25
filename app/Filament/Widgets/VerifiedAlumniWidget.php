<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Displays the number of verified alumni as a Filament stats card.
 */

class VerifiedAlumniWidget extends BaseWidget
{
    protected static ?int $sort = -10;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Verified Alumni', User::whereHas('curriculumVitae')->whereNotNull('email_verified_at')->count())
                ->description('Alumni with verified account')
                ->descriptionIcon('heroicon-m-check-badge')
                ->extraAttributes([
                    'style' => 'cursor: pointer',
                    'onclick' => "window.location.href='/admin/user-list?filter=alumni_verified';",
                ])
                ->color('success'),
        ];
    }
}
