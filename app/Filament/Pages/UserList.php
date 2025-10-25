<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class UserList extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;
    protected static ?string $navigationLabel = 'User List';
    protected string $view = 'filament.pages.user-list';

    public function getTitle(): string
    {
        return 'User List';
    }

    public function getSubheading(): ?string
    {
        return 'Manage and filter users in the system';
    }
}
