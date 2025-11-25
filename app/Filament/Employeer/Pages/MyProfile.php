<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use BackedEnum;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Icons\Heroicon;

class MyProfile extends Page
{
    protected string $view = 'filament.employeer.pages.my-profile';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::User;
    protected static ?string $recordTitleAttribute = 'My Profile';
    protected static ?string $navigationLabel = 'My Profile';
    protected static ?string $slug = 'My Profile';
    public static function getNavigationSort(): ?int
    {
        $user = Auth::user();
        if ($user && $user->roles()->where('name', env('USER_APPLICANT_ROLE'))->exists()) {
            return -21;
        }
        return null;
    }
    public static function canAccess(): bool
    {
        $user = Auth::user();
        if (!$user) return false;

        $applicantRole = env('USER_EMPLOYEER_ROLE');
        if ($user->roles()->where('name', $applicantRole)->exists()) return false;

        $defaultRole = env('USER_DEFAULT_ROLE');
        return !$user->roles()->where('name', $defaultRole)->exists();
    }
}
