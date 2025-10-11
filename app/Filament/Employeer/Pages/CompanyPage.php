<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CompanyPage extends Page
{
    protected string $view = 'filament::filament.employeer.pages.company-page';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;
    protected static ?string $recordTitleAttribute = ' Your Campany Profile ';
    protected static ?string $navigationLabel = 'Company Profile';
    protected static ?string $slug = 'Company Profile';


    public static function canAccess(): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        // Hide Company Profile navigation if user role is applicant
        $applicantRole = env('USER_APPLICANT_ROLE');
        if ($user->roles()->where('name', $applicantRole)->exists()) {
            return false;
        }

        // Make it visible if Company_id session exists and is not null
        if (Session::get('Company_id') !== null) {
            return true;
        }

        // Fallback to existing logic for other cases
        $defaultRole = env('USER_DEFAULT_ROLE');
        return !$user->roles()->where('name', $defaultRole)->exists();
    }

}
