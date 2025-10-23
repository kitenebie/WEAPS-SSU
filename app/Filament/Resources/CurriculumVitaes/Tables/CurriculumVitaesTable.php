<?php

namespace App\Filament\Resources\CurriculumVitaes\Tables;

use App\Models\CurriculumVitae;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
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
                ImageColumn::make('profile_picture'),
                ImageColumn::make('front_id'),
                ImageColumn::make('back_id'),
                IconColumn::make('isActive')
                    ->label('Admin Verified')
                    ->boolean(),
                IconColumn::make('isAiValidate')
                    ->label('AI Verified') 
                    ->boolean(),
                TextColumn::make('user.first_name')
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
                TextColumn::make('user.AI_reason')
                    ->label('Verification Remarks')
                    ->searchable()
                    ->formatStateUsing(fn($state, $record) =>
                        $record->user->AI_reason === null && $record->isAiValidate
                            ? 'This account is verified manually by the admin since the images are not clearly detected by the Face detection.'
                            : $record->user->AI_reason
                    ),
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
