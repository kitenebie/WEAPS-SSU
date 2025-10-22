<?php

namespace App\Filament\Resources\CurriculumVitaes\Tables;

use App\Models\CurriculumVitae;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CurriculumVitaesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(CurriculumVitae::whereHas('user', function ($query) {
                $query->whereDoesntHave('companies');
            }))
            ->columns([
                TextColumn::make('first_name')
                    ->name('firstName')
                    ->searchable(),
                TextColumn::make('middle_name')
                    ->name('middleName')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->name('lastName')
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
                TextColumn::make('profile_picture')
                    ->searchable(),
                TextColumn::make('facebook_url')
                    ->searchable(),
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('isActive')
                    ->label('Admin Verified')
                    ->boolean(),
                IconColumn::make('isAiValidate')
                    ->label('AI Verified')
                    ->boolean(),
                TextColumn::make('front_id')
                    ->searchable(),
                TextColumn::make('back_id')
                    ->searchable(),
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
