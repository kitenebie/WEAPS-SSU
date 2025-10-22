<?php

namespace App\Filament\Employeer\Pages;

use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Filament\Notifications\Notification;

use Filament\Pages\Page;

class Careers extends Page
{

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CheckBadge;
    protected static ?string $recordTitleAttribute = 'Careers';
    protected static ?string $navigationLabel = 'Careers';
    protected static ?string $slug = 'careers';
    protected string $view = 'filament.employeer.pages.careers';
    public static function canAccess(): bool
    {
        // Check if user is authenticated
        if (!Auth::check()) {
        return false;
        }
        if(Auth::user()->hasRole(env('USER_APPLICANT_ROLE')) || Auth::user()->hasRole(env('ADMIN_ROLE'))  || Auth::user()->hasRole(env('SUPER_ADMIN_ROLE'))){
            return true;
        }

        // Check if user has alumni role
        if (!Auth::user()->hasRole('super_admin')) {
            return false;
        }
        return true;
    }
}
