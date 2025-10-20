<?php

namespace App\Filament\Employeer\Pages;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Filament\Pages\Page;

class Careers extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CheckBadge;
    protected static ?string $recordTitleAttribute = ' Careers ';
    protected static ?string $navigationLabel = 'Careers';
    protected static ?string $slug = 'careers';
    protected string $view = 'filament::filament.employeer.pages.careers';
}
