<?php

namespace App\Filament\Employeer\Resources\Companies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CompanyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('type'),
                TextEntry::make('location'),
                TextEntry::make('founded_year')
                    ->numeric(),
                TextEntry::make('employee_count')
                    ->numeric(),
                TextEntry::make('industry'),
                TextEntry::make('company_size'),
                TextEntry::make('website'),
                TextEntry::make('phone'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('cover_photo'),
                TextEntry::make('logo'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
