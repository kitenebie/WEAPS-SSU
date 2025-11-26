<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
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
use Filament\Support\Enums\Width;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin as ShieldPlugin;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Resma\FilamentAwinTheme\FilamentAwinTheme;
use Filament\Support\Enums\ActionSize;
use App\Http\Middleware\EmployerRoleMiddleware;
use Filament\Actions\Action;
use Filament\Facades\Filament;

class EmployeerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('employeer')
            ->path('/')
            ->login(\App\Filament\Employeer\Pages\Auth\Login::class)
            ->registration(\App\Filament\Employeer\Pages\Auth\Register::class)
            ->passwordReset()
            ->emailVerification()
            ->emailChangeVerification()
            ->brandLogo(asset('https://cdn.bulan.sorsu.edu.ph/images/ssu-logo.webp'))
            ->brandLogoHeight('3rem')
            // ->topNavigation(true)
            ->colors([
                'primary' => Color::Gray,
                'warning' => Color::Orange,
                'info' => Color::Blue,
            ])
            ->darkMode(false)
            ->discoverResources(in: app_path('Filament/Employeer/Resources'), for: 'App\Filament\Employeer\Resources')
            ->pages([
                \App\Filament\Employeer\Pages\Verification::class,
            ])
            ->discoverPages(in: app_path('Filament/Employeer/Pages'), for: 'App\Filament\Employeer\Pages')
            ->discoverWidgets(in: app_path('Filament/Employeer/Widgets'), for: 'App\Filament\Employeer\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                // FilamentAwinTheme::make(),
                ShieldPlugin::make(), // Registers RoleResource (Spatie Shield)
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
                EmployerRoleMiddleware::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->globalSearch(false)
            ->maxContentWidth(Width::Full);
    }
    public function widgets(): array
    {
        return [
            \App\Filament\Widgets\ApplicantStatsWidget::class,
        ];
    }
}
