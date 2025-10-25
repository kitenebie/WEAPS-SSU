<?php

namespace App\Filament\Resources\SystemLogs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SystemLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('model_type')
                    ->required(),
                TextInput::make('model_id')
                    ->required()
                    ->numeric(),
                TextInput::make('action')
                    ->required(),
                Textarea::make('changes')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->default(null),
                TextInput::make('ip_address')
                    ->default(null),
                Textarea::make('user_agent')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
