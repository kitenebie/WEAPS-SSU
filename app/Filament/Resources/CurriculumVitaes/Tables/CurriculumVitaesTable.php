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
            ->query(
                CurriculumVitae::query()
                    ->whereHas('user', function ($query) {
                        $query->whereDoesntHave('companies');
                    })
                    ->with('user')
            )
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
                    ->label('First name')
                    ->searchable(),
                TextColumn::make('user.middle_name')
                    ->label('Middle name')
                    ->searchable(),
                TextColumn::make('user.last_name')
                    ->label('Last name')
                    ->searchable(),
                TextColumn::make('user.email')
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
                    ->formatStateUsing(function ($state, $record) {
                        // Use the resolved state from the related user column. Avoid reading $record->AI_reason (belongs to CV).
                        $reason = is_string($state) ? trim($state) : ($state ?? null);

                        if ((bool) $record->isAiValidate) {
                            if ($reason === null || $reason === '') {
                                return 'This account is verified manually by the admin since the images are not clearly detected by the Face detection.';
                            }
                            return $reason;
                        }

                        return ($reason !== null && $reason !== '') ? $reason : '-';
                    }),
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
