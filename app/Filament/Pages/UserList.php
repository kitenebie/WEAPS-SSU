<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class UserList extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;
    protected string $view = 'filament::filament.pages.user-list';
}
