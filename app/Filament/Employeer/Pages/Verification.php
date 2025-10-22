<?php

namespace App\Filament\Employeer\Pages;

use BackedEnum;
use Illuminate\Support\Facades\Auth;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Verification extends Page
{
    use HasPageShield;

    protected static ?int $navigationSort = -10;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShieldCheck;
    protected static ?string $navigationLabel = 'Verification';
    protected static ?string $title = 'Verification';
    protected string $view = 'filament.employeer.pages.verification';

}