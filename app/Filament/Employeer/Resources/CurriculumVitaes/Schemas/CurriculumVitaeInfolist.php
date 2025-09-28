<?php

namespace App\Filament\Employeer\Resources\CurriculumVitaes\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CurriculumVitaeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Grid::make()
                            ->gridContainer()
                            ->columns([
                                'sm' => 1,
                                'lg' => 2,
                            ])->columnSpanFull()
                            ->schema([
                                Grid::make()
                                    ->columns(2)
                                    ->columnSpanFull()
                                    ->schema([
                                        Section::make('Personal Information')
                                            ->description('Basic personal and contact details')
                                            ->schema([
                                                Grid::make()
                                                    ->columns([
                                                        'sm' => 2,
                                                        'lg' => 3,
                                                    ])
                                                    ->schema([
                                                        ImageEntry::make('profile_picture')
                                                            ->hiddenLabel()
                                                            ->imageSize(200),
                                                        Grid::make()
                                                            ->columns(1)
                                                            ->schema([
                                                                TextEntry::make('first_name'),
                                                                TextEntry::make('last_name'),
                                                                TextEntry::make('middle_name'),
                                                            ]),
                                                        Grid::make()
                                                            ->columns(1)
                                                            ->schema([
                                                                TextEntry::make('email')
                                                                    ->label('Email address'),
                                                                TextEntry::make('phone'),
                                                                TextEntry::make('address'),
                                                            ]),
                                                    ])
                                            ]),
                                        Section::make('Professional Summary')
                                            ->description('Career overview and key qualifications')
                                            ->icon('heroicon-o-briefcase')
                                            ->schema([
                                                TextEntry::make('job_title'),
                                                TextEntry::make('summary'),
                                                TextEntry::make('years_of_experience'),
                                            ]),
                                    ]),
                                Grid::make()
                                    ->columns(1)
                                    ->schema([
                                        Section::make('Certifications & Awards')
                                            ->description('Professional certifications and awards received')
                                            ->icon('heroicon-o-trophy')
                                            ->schema([
                                                Section::make('Certifications')
                                                    ->schema([
                                                        TextEntry::make('name'),
                                                        TextEntry::make('issuer'),
                                                        TextEntry::make('date_obtained'),
                                                        TextEntry::make('credential_id'),
                                                    ]),
                                                Section::make('Awards & Honors')
                                                    ->schema([
                                                        TextEntry::make('name'),
                                                        TextEntry::make('organization'),
                                                        TextEntry::make('date_obtained'),
                                                        TextEntry::make('credential_id'),
                                                    ])
                                            ]),
                                    ]),
                                Grid::make()
                                    ->columns(1)
                                    ->schema([
                                        Section::make('Skills & Languages')
                                            ->description('Technical skills and language proficiencies')
                                            ->icon('heroicon-o-language')
                                            ->schema([
                                                Section::make()
                                                    ->schema([
                                                        TextEntry::make('highest_degree'),
                                                        TextEntry::make('university'),
                                                        TextEntry::make('graduation_year'),
                                                        TextEntry::make('years_of_experience')
                                                            ->numeric(),
                                                    ])->columns(4)
                                            ])->compact(),
                                        Section::make('Affiliations & Publications')
                                            ->description('Professional memberships and published works')
                                            ->icon('heroicon-o-building-office')
                                            ->schema([
                                                Section::make('Professional Affiliations')
                                                    ->schema([
                                                        TextEntry::make('organization'),
                                                        TextEntry::make('role'),
                                                        TextEntry::make('start_date'),
                                                        TextEntry::make('end_date'),
                                                        TextEntry::make('description')->columnSpanFull(),
                                                    ])->columns(2),
                                                Section::make('publications')
                                                    ->schema([
                                                        TextEntry::make('title'),
                                                        TextEntry::make('journal'),
                                                        TextEntry::make('authors'),
                                                        TextEntry::make('publication_date'),
                                                        TextEntry::make('doi')->columnSpanFull(),
                                                    ])->columns(2)
                                            ]),
                                    ]),

                                Section::make('Volunteer Work & References')
                                    ->description('Community involvement and professional references')
                                    ->icon('heroicon-o-heart')
                                    ->schema([
                                        Grid::make()
                                            ->columns(2)
                                            ->schema([
                                                Section::make('Volunteer Work')
                                                    ->schema([
                                                        TextEntry::make('organization'),
                                                        TextEntry::make('role'),
                                                        TextEntry::make('start_date'),
                                                        TextEntry::make('end_date'),
                                                        TextEntry::make('description')->columnSpanFull(),
                                                    ]),
                                                Section::make('Professional References')
                                                    ->schema([
                                                        TextEntry::make('name'),
                                                        TextEntry::make('title'),
                                                        TextEntry::make('company'),
                                                        TextEntry::make('email'),
                                                        TextEntry::make('phone'),
                                                        TextEntry::make('relationship')->columnSpanFull(),
                                                    ])->columns(2),
                                            ]),
                                    ])->columnSpanFull(),
                            ]),
                        Section::make('Social Links')
                            ->description('Professional online presence')
                            ->icon('heroicon-o-globe-alt')
                            ->columns(4)
                            ->schema([
                                TextEntry::make('linkedin_url'),
                                TextEntry::make('github_url'),
                                TextEntry::make('portfolio_url'),
                                TextEntry::make('facebook_url'),
                            ])->columnSpanFull(),
                    ])->columnSpanFull()
            ]);
    }
}
