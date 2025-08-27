<?php

namespace App\Filament\Alumni\Pages;
use BackedEnum;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Jobs extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Briefcase;
    protected static ?string $navigationLabel = 'Jobs Hiring';         // label sa sidebar
    protected static ?string $title = '';                   // page title

    protected string $view = 'filament::filament.alumni.pages.jobs';
}
