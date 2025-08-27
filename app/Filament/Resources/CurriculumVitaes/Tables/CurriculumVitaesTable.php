<?php

namespace App\Filament\Resources\CurriculumVitaes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CurriculumVitaesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('middle_name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('address')
                    ->searchable(),
                TextColumn::make('job_title')
                    ->searchable(),
                TextColumn::make('highest_degree')
                    ->searchable(),
                TextColumn::make('university')
                    ->searchable(),
                TextColumn::make('graduation_year'),
                TextColumn::make('years_of_experience')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('linkedin_url')
                    ->searchable(),
                TextColumn::make('github_url')
                    ->searchable(),
                TextColumn::make('portfolio_url')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
