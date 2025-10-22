<?php

namespace App\Filament\Employeer\Resources\Companies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_handle')
                    ->label('User Handle')
                    ->searchable()
                    ->placeholder('No handle'),
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('founded_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('employee_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('industry')
                    ->searchable(),
                TextColumn::make('company_size')
                    ->searchable(),
                TextColumn::make('website')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                BadgeColumn::make('Document_Permit')
                    ->label('Documents')
                    ->colors([
                        'primary',
                        'secondary' => 'draft',
                        'warning' => 'warning',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->placeholder('No documents'),
                TextColumn::make('cover_photo')
                    ->searchable(),
                TextColumn::make('logo')
                    ->searchable(),
                BooleanColumn::make('isActive')
                    ->label('Active Status')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
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
