<?php

namespace App\Filament\Resources\CurriculumVitaes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CurriculumVitaeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('middle_name')
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('address')
                    ->default(null),
                TextInput::make('job_title')
                    ->default(null),
                Textarea::make('summary')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('highest_degree')
                    ->default(null),
                TextInput::make('university')
                    ->default(null),
                TextInput::make('graduation_year')
                    ->default(null),
                TextInput::make('years_of_experience')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('skills')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('work_experience')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('linkedin_url')
                    ->default(null),
                TextInput::make('github_url')
                    ->default(null),
                TextInput::make('portfolio_url')
                    ->default(null),
            ]);
    }
}
