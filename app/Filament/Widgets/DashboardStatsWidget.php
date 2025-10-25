<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Company;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Schemas\Components\Fieldset;

class DashboardStatsWidget extends BaseWidget
{
    protected static ?int $sort = -20;

    protected function getStats(): array
    {
        return [
            Fieldset::make()
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 4,
                ])->columnSpanFull()
                ->schema([
                    Stat::make('Total Users', User::count())
                        ->description('All registered users')
                        ->descriptionIcon('heroicon-m-users')
                        ->extraAttributes([
                            'style' => 'cursor: pointer;  border: 1px solid #CAD5E2; border: 1px solid #CAD5E2',
                            'onclick' => "window.location.href='/admin/user-list?filter=users_list';",
                        ])
                        ->color('primary'),

                    Stat::make('Verified Users', User::whereNotNull('email_verified_at')->count())
                        ->description('Users with verified account')
                        ->descriptionIcon('heroicon-m-check-badge')
                        ->extraAttributes([
                            'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                            'onclick' => "window.location.href='/admin/user-list?filter=users_verified';",
                        ])
                        ->color('success'),

                    Stat::make('Unverified Users', User::whereNull('email_verified_at')->count())
                        ->description('Users pending verification')
                        ->descriptionIcon('heroicon-m-exclamation-triangle')
                        ->extraAttributes([
                            'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                            'onclick' => "window.location.href='/admin/user-list?filter=users_unverified';",
                        ])
                        ->color('warning'),

                    Stat::make('Verified Alumni', User::whereHas('curriculumVitae')->whereNotNull('email_verified_at')->count())
                        ->description('Alumni with verified account')
                        ->descriptionIcon('heroicon-m-check-badge')
                        ->extraAttributes([
                            'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                            'onclick' => "window.location.href='/admin/user-list?filter=alumni_verified';",
                        ])
                        ->color('success'),

                    Stat::make('Unverified Alumni', User::whereHas('curriculumVitae')->whereNull('email_verified_at')->count())
                        ->description('Alumni with unverified acoount')
                        ->descriptionIcon('heroicon-m-exclamation-triangle')
                        ->extraAttributes([
                            'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                            'onclick' => "window.location.href='/admin/user-list?filter=alumni_unverified';",
                        ])
                        ->color('warning'),

                    Stat::make('Total Companies', Company::count())
                        ->description('All registered companies')
                        ->descriptionIcon('heroicon-m-building-office')
                        ->extraAttributes([
                            'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                            'onclick' => "window.location.href='/admin/user-list?filter=company_list';",
                        ])
                        ->color('primary'),

                    Stat::make('Active Companies', Company::where('isActive', true)->count())
                        ->description('Currently active companies')
                        ->descriptionIcon('heroicon-m-check-circle')
                        ->extraAttributes([
                            'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                            'onclick' => "window.location.href='/admin/user-list?filter=company_active';",
                        ])
                        ->color('success'),

                    Stat::make('Unverified Companies', Company::where('isActive', false)->count())
                        ->description('Unverified companies')
                        ->descriptionIcon('heroicon-m-x-circle')
                        ->extraAttributes([
                            'style' => 'cursor: pointer;  border: 1px solid #CAD5E2',
                            'onclick' => "window.location.href='/admin/user-list?filter=company_unverified';",
                        ])
                        ->color('danger'),
                ])
        ];
    }
}
