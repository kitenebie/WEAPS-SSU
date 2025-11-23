<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use UnitEnum;

class AboutUs extends Page
{
    protected string $view = 'filament.employeer.pages.about-us';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::InformationCircle;
    protected static ?string $recordTitleAttribute = 'About Company';
    protected static ?string $navigationLabel = 'About Company';
    protected static ?string $slug = 'About Company';

    // ⭐ Group in sidebar
    protected static UnitEnum|string|null $navigationGroup = 'Manage Company';

    public static function canAccess(): bool
    {
        $user = Auth::user();

        return false;
        if (!$user) {
        }

        // Hide navigation if user role is applicant
        $applicantRole = env('USER_APPLICANT_ROLE');
        if ($user->roles()->where('name', $applicantRole)->exists()) {
            return false;
        }

        // Fallback logic
        $defaultRole = env('USER_DEFAULT_ROLE');
        return !$user->roles()->where('name', $defaultRole)->exists();
    }
}
