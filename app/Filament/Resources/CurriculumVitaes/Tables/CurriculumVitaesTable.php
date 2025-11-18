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
use Filament\Tables\Enums\RecordActionsPosition;

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
                TextColumn::make('School_id')
                    ->toggleable()
                    ->searchable(),
                ImageColumn::make('profile_picture')
                    ->toggleable(),
                ImageColumn::make('front_id')
                    ->toggleable(),
                ImageColumn::make('back_id')
                    ->toggleable(),
                IconColumn::make('isActive')
                    ->label('Admin Verified')
                    ->toggleable()
                    ->boolean(),
                IconColumn::make('isAiValidate')
                    ->label('AI Verified')
                    ->toggleable()
                    ->boolean(),
                TextColumn::make('user.first_name')
                    ->label('First name')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('user.middle_name')
                    ->label('Middle name')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('user.last_name')
                    ->label('Last name')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email address')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('address')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('user.employment_status')
                    ->toggleable()
                    ->label('Employment Status'),
                TextColumn::make('job_title')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('highest_degree')
                    ->label('Highest Degree')
                    ->getStateUsing(function ($record) {
                        return $record->highest_degree;
                    })
                    ->toggleable()
                    ->searchable(query: function ($query, $data) {
                        return $query->whereHas('education', function ($q) use ($data) {
                            $q->where('degree', 'like', '%' . $data . '%');
                        });
                    }),
                TextColumn::make('university')
                    ->toggleable()
                    ->label('University')
                    ->getStateUsing(function ($record) {
                        return $record->university;
                    })
                    ->searchable(query: function ($query, $data) {
                        return $query->whereHas('education', function ($q) use ($data) {
                            $q->where('school_name', 'like', '%' . $data . '%');
                        });
                    }),
                TextColumn::make('years_of_experience')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user.AI_reason')
                    ->label('Verification Remarks')
                    ->toggleable()
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
            ->columnToggleLayout('grid')     // <-- makes the toggle use a grid
            ->columnToggleColumns(3)
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ], RecordActionsPosition::BeforeColumns)
            ->toolbarActions(actions: [
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
