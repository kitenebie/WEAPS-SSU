<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminRoleMiddleware;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Resma\FilamentAwinTheme\FilamentAwinTheme;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Enums\Width;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->breadcrumbs(false)
            ->passwordReset()
            ->emailVerification()
            ->emailChangeVerification()
            ->profile()
            ->subNavigationPosition(SubNavigationPosition::End)
            // ->brandLogo(asset('https://cdn.bulan.sorsu.edu.ph/images/ssu-logo.webp'))
            // ->brandLogoHeight('3rem')
            // ->topNavigation(true)
            ->colors([
                'primary' => Color::Gray,
                'warning' => Color::Orange,
                'info' => Color::Blue,

            ])
            ->darkMode(false)
            ->plugins([
                FilamentApexChartsPlugin::make(),
                FilamentShieldPlugin::make(), // Registers RoleResource (Spatie Shield)
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
                \App\Filament\Pages\UserList::class,
            ])

            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\DashboardStatsWidget::class,
                \App\Filament\Widgets\ApplicationFrequencyChart::class,
                \App\Filament\Widgets\HiringAnalyticsChart::class,
                \App\Filament\Widgets\CareerPostsChart::class,
                \App\Filament\Widgets\ApplicantHiringDistributionChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                AdminRoleMiddleware::class,
            ])
            ->globalSearch(false)
            ->authMiddleware([
                Authenticate::class,
            ])
            ->maxContentWidth(Width::Full)
            ->userMenuItems([
                'logout' => fn(Action $action) => $action->label('Log out')
                    ->hidden()
                    ->action(fn() => dd('logout')),
                Action::make('new')
                    ->action(function(){
                        Notification::make()->title('Success')->send();
                    })
                // Action::make('delete')
                //     ->schema([])
                //     ->requiresConfirmation()
                //     ->modalHeading('Delete post')
                //     ->modalDescription('Are you sure you\'d like to delete this post? This cannot be undone.')
                //     ->modalSubmitActionLabel('Yes, delete it')
            ]);
    }
}
