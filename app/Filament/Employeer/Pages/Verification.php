<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Illuminate\Support\Facades\Auth;

class Verification extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;
    protected static ?string $navigationLabel = 'Verification';
    protected static ?string $title = 'Verification';

    public static function canAccess(): bool
    {
        return false;
    }
    protected string $view = 'filament::filament.employeer.pages.verification';
}
