<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MyApplication extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::FolderArrowDown;
    protected static ?string $navigationLabel = 'My-Application';
    protected static ?string $slug = 'My-Application';
    protected static ?string $recordTitleAttribute = 'My-Application';

    protected string $view = 'filament.employeer.pages.my-application';
    public static function canAccess(): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        // Hide Company Profile navigation if user role is applicant
        $applicantRole = env('USER_APPLICANT_ROLE');
        if ($user->roles()->where('name', $applicantRole)->exists()) {
            return true;
        }

        return false;
    }
}
