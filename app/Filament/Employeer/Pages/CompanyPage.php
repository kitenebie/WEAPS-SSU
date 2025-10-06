<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class CompanyPage extends Page
{
    protected string $view = 'filament::filament.employeer.pages.company-page';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = ' Your Campany Profile ';
    protected static ?string $navigationLabel = 'Company Profile';
    protected static ?string $slug = 'Company Profile';
}
