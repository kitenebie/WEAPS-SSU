<?php

namespace App\Filament\Employeer\Pages;

use BackedEnum;
use Illuminate\Support\Facades\Auth;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Recruiting extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;
    protected static ?string $navigationLabel = 'Applicants';
    protected static ?string $title = 'Recruiting';
    protected string $view = 'filament.employeer.pages.recruiting';

    public static function canAccess(): bool
    {
        return false;
    }
}
