<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
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
            ->topNavigation(true)
            ->colors([
                'primary' => Color::Rose,
                'danger' => Color::Rose,
            ])
            ->darkMode(false)
            ->plugins([
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                        userMenuLabel: 'My Profile', // Customizes the 'account' link label in the panel User Menu (default = null)
                        shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                        navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                        hasAvatars: false, // Enables the avatar upload form component (default = false)
                        slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                    )
                    ->enableTwoFactorAuthentication(),
                FilamentAwinTheme::make(),
                FilamentApexChartsPlugin::make(),
                FilamentShieldPlugin::make(), // Registers RoleResource (Spatie Shield)
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\TotalUsersWidget::class,
                \App\Filament\Widgets\VerifiedUsersWidget::class,
                \App\Filament\Widgets\UnverifiedUsersWidget::class,
                \App\Filament\Widgets\TotalCompaniesWidget::class,
                \App\Filament\Widgets\ActiveCompaniesWidget::class,
                \App\Filament\Widgets\InactiveCompaniesWidget::class,
                // \App\Filament\Widgets\ApplicationFrequencyChart::class,
                // \App\Filament\Widgets\HiringAnalyticsChart::class,
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
            ->authMiddleware([
                Authenticate::class,
            ])
            ->maxContentWidth(Width::Full);
    }
}
