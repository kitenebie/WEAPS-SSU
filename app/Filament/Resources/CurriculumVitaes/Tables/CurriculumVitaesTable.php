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
                    ->searchable(),
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
                TextColumn::make('user.employment_status')
                    ->label('Employment Status')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'employed' => 'Employed',
                        'unemployed' => 'Unemployed',
                        default => 'Unknown',
                    }),
                TextColumn::make('job_title')
                    ->searchable(),
                TextColumn::make('highest_degree')
                    ->label('Highest Degree')
                    ->getStateUsing(function ($record) {
                        return $record->highest_degree;
                    })
                    ->searchable(query: function ($query, $data) {
                        return $query->whereHas('education', function ($q) use ($data) {
                            $q->where('degree', 'like', '%' . $data . '%');
                        });
                    }),
                TextColumn::make('university')
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
            ], RecordActionsPosition::BeforeColumns)
            ->toolbarActions(actions: [
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
