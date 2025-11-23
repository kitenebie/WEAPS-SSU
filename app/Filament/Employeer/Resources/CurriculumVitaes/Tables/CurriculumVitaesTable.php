<?php

namespace App\Filament\Employeer\Resources\CurriculumVitaes\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Forms;
use App\Models\CurriculumVitae;
use Filament\Infolists\Components\TextEntry;



class CurriculumVitaesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(
                CurriculumVitae::query()
                    ->whereHas('user', function ($query) {
                        $query->whereDoesntHave('companies')
                              ->whereNot('employment_status', 'employed');
                    })
                    ->with('user')
            )
            ->columns([
                Stack::make([
                    ImageColumn::make('profile_picture')
                        ->label('')
                        ->circular()
                        ->size(80)
                        ->alignCenter()
                        ->getStateUsing(fn ($state) => $state ?: 'https://static.vecteezy.com/system/resources/previews/024/766/958/non_2x/default-male-avatar-profile-icon-social-media-user-free-vector.jpg'),
                    Stack::make([
                        TextColumn::make('fullname')
                            ->label('Name')
                            ->weight(FontWeight::Bold)
                            ->size('lg'),

                        TextColumn::make('job_title')
                            ->label('Position')
                            ->icon('heroicon-m-briefcase')
                            ->color('gray')
                            ->size('sm'),

                        TextColumn::make('highest_degree')
                            ->label('Degree')
                            ->icon('heroicon-m-academic-cap')
                            ->color('gray')
                            ->size('xs'),
                    ]),

                    Stack::make([
                        TextColumn::make('email')
                            ->icon('heroicon-m-envelope'),

                        TextColumn::make('phone')
                            ->icon('heroicon-m-phone'),

                        TextColumn::make('address')
                            ->label('Location')
                            ->icon('heroicon-m-map-pin')
                            ->color('gray'),
                    ])->space(1),
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 4,
            ])
            ->paginated([12, 24, 48, 96, 'all'])
            ->searchable(['first_name', 'last_name', 'email', 'job_title', 'highest_degree', 'university'])
            ->filters([
                SelectFilter::make('highest_degree')
                    ->label('Education Level')
                    ->options([
                        'BS in Computer Science' => 'BS in Computer Science',
                        'BS in Information Technology' => 'BS in Information Technology',
                        'BS in Information System' => 'BS in Information System',
                        'BS in Accountancy' => 'BS in Accountancy',
                        'BS in Accounting Information System' => 'BS in Accounting Information System',
                        'BS in Entrepreneurship (BS Entrep)' => 'BS in Entrepreneurship',
                        'Bachelor of Public Administration' => 'Bachelor of Public Administration',
                    ])
                    ->multiple()
                    ->placeholder('Filter by degree'),

                SelectFilter::make('years_of_experience')
                    ->label('Experience Level')
                    ->options([
                        '0-2' => 'Entry Level (0-2 years)',
                        '3-5' => 'Mid Level (3-5 years)',
                        '6-10' => 'Senior Level (6-10 years)',
                        '10+' => 'Expert Level (10+ years)',
                    ])
                    ->query(function ($query, $data) {
                        if ($data['value'] === '0-2') {
                            return $query->where('years_of_experience', '<=', 2);
                        } elseif ($data['value'] === '3-5') {
                            return $query->whereBetween('years_of_experience', [3, 5]);
                        } elseif ($data['value'] === '6-10') {
                            return $query->whereBetween('years_of_experience', [6, 10]);
                        } elseif ($data['value'] === '10+') {
                            return $query->where('years_of_experience', '>=', 10);
                        }
                        return $query;
                    })
                    ->placeholder('Filter by experience'),

                Filter::make('has_projects')
                    ->label('Has Projects')
                    ->query(fn($query) => $query->whereNotNull('projects'))
                    ->toggle(),

                Filter::make('has_certifications')
                    ->label('Has Certifications')
                    ->query(fn($query) => $query->whereNotNull('certifications'))
                    ->toggle(),
            ])
            ->recordActions([
                // EditAction::make()->button()->outlined()->color('primary'),
                ViewAction::make('edit')->button()->outlined()->color('primary')
                    ->schema([
                        TextEntry::make('title'),
                    ])
            ]);
        // ->recordUrl(fn ($record) => route('filament.employeer.pages.recruiting', $record->id));
        // ->recordUrl(fn ($record) => route('cv.view', $record->id));
        // resources\views\filament\employeer\pages\recruiting.blade.php
    }
}
