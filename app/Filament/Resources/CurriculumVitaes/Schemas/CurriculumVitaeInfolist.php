<?php

namespace App\Filament\Resources\CurriculumVitaes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CurriculumVitaeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('first_name'),
                TextEntry::make('last_name'),
                TextEntry::make('middle_name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('phone'),
                TextEntry::make('address'),
                TextEntry::make('job_title'),
                TextEntry::make('highest_degree'),
                TextEntry::make('university'),
                TextEntry::make('graduation_year'),
                TextEntry::make('years_of_experience')
                    ->numeric(),
                TextEntry::make('linkedin_url'),
                TextEntry::make('github_url'),
                TextEntry::make('portfolio_url'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
