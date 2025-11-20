<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CompanyPage extends Page
{
    protected string $view = 'filament::filament.employeer.pages.company-page';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;
    protected static ?string $recordTitleAttribute = ' Your Campany Profile ';
    protected static ?string $navigationLabel = 'Company Profile';
    protected static ?string $slug = 'Company Profile';

    public static function shouldRegisterNavigation(): bool
    {
        return Cache::get('key') === null;
    }


    public static function canAccess(): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }
        // dd(Session::get('Company_id'));
        $data = Cache::get('key');
        // Make it visible if Company_id session exists and is not null
        if ($data !== null) {
            return true;
        }

        // Hide Company Profile navigation if user role is applicant
        $applicantRole = env('USER_APPLICANT_ROLE');
        if ($user->roles()->where('name', $applicantRole)->exists()) {
            return false;
        }

        // Fallback to existing logic for other cases
        $defaultRole = env('USER_DEFAULT_ROLE');
        return !$user->roles()->where('name', $defaultRole)->exists();
    }
}
