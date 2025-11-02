<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('first_name')
                    ->default(null),
                TextInput::make('middle_name')
                    ->default(null),
                TextInput::make('last_name')
                    ->default(null),
                Select::make('employment_status')
                    ->label('Employment Status')
                    ->options([
                        'employed' => 'Employed',
                        'unemployed' => 'Unemployed',
                    ])
                    ->nullable(),
            ]);
    }
}
