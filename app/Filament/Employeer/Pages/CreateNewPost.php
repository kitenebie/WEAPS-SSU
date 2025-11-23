<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use UnitEnum;

class CreateNewPost extends Page
{
    protected string $view = 'filament.employeer.pages.create-new-post';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::TableCells;
    protected static ?string $recordTitleAttribute = 'Create New Post';
    protected static ?string $navigationLabel = 'Create New Post';
    protected static ?string $slug = 'Posts';

    // ⭐ Group in sidebar
    protected static UnitEnum|string|null $navigationGroup = 'Manage Company';

    public static function canAccess(): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
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
