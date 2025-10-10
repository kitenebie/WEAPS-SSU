<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CompanyPage extends Page
{
    protected string $view = 'filament::filament.employeer.pages.company-page';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;
    protected static ?string $recordTitleAttribute = ' Your Campany Profile ';
    protected static ?string $navigationLabel = 'Company Profile';
    protected static ?string $slug = 'Company Profile';


    public static function canAccess(): bool
    {
        // Check if user has required role to access this page
        $user = Auth::user();
        return !$user->hasAnyRole([env('USER_DEFAULT_ROLE')]);
    }

}
