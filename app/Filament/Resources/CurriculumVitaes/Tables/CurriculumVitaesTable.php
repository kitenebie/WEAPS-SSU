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
use Filament\Support\Enums\Width;
use Filament\Tables\Filters\SelectFilter;

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
                    ->imageHeight(80)->imageWidth(80)
                    ->square()
                    ->toggleable(),
                ImageColumn::make('front_id')
                    ->imageHeight(80)->imageWidth(80)
                    ->square()
                    ->toggleable(),
                ImageColumn::make('back_id')
                    ->imageHeight(80)->imageWidth(80)
                    ->square()
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
                // TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->columnManagerColumns(4)
            ->filters([
                SelectFilter::make('isActive')
                    ->label('Admin Verified')
                    ->options([
                        '1' => 'Verified',
                        '0' => 'Not Verified',
                    ])
                    ->query(function ($query, $data) {
                        if (isset($data['value'])) {
                            $query->where('isActive', $data['value']);
                        }
                    }),
                SelectFilter::make('isAiValidate')
                    ->label('AI Verified')
                    ->options([
                        '1' => 'Verified',
                        '0' => 'Not Verified',
                    ])
                    ->query(function ($query, $data) {
                        if (isset($data['value'])) {
                            $query->where('isAiValidate', $data['value']);
                        }
                    }),
                // SelectFilter::make('employment_status')
                //     ->label('Employment Status')
                //     ->options(fn() => \App\Models\User::whereNotNull('employment_status')->distinct('employment_status')->pluck('employment_status', 'employment_status')->toArray())
                //     ->query(function ($query, $data) {
                //         if ($data['value']) {
                //             $query->whereHas('user', fn($q) => $q->where('employment_status', $data['value']));
                //         }
                //     }),
                // SelectFilter::make('highest_degree')
                //     ->label('Highest Degree')
                //     ->options(fn() => \App\Models\CurriculumVitae::whereNotNull('highest_degree')->distinct('highest_degree')->pluck('highest_degree', 'highest_degree')->toArray())
                //     ->query(function ($query, $data) {
                //         if ($data['value']) {
                //             $query->where('highest_degree', $data['value']);
                //         }
                //     }),
            ])
            ->recordActions([
                ViewAction::make()
                    ->button()
                    ->color('info'),
                EditAction::make()
                    ->button()
                    ->color('primary'),
            ], RecordActionsPosition::BeforeColumns)
            ->toolbarActions(actions: [
                DeleteBulkAction::make()->color('warning'),
            ]);
    }
}
