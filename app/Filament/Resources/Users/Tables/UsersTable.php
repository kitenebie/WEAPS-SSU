<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Enums\RecordActionsPosition;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('companies.name')
                    ->label('Company Name')
                    ->searchable(),
                TextColumn::make('companies.type')
                    ->label('Company Type')
                    ->searchable(),
                TextColumn::make('companies.location')
                    ->label('Location')
                    ->searchable(),
                TextColumn::make('companies.founded_year')
                    ->label('Founded Year')
                    ->searchable(),
                TextColumn::make('companies.employee_count')
                    ->label('Employee Count')
                    ->searchable(),
                TextColumn::make('companies.description')
                    ->label('Description')
                    ->wrap()
                    ->lineClamp(2)
                    ->searchable(),
                TextColumn::make('companies.industry')
                    ->label('Industry')
                    ->searchable(),
                TextColumn::make('companies.company_size')
                    ->label('Company Size')
                    ->searchable(),
                // TextColumn::make('companies.specialties')
                //     ->label('Specialties')
                //     ->searchable(),
                // TextColumn::make('companies.website')
                //     ->label('Website')
                //     ->searchable(),
                // TextColumn::make('companies.phone')
                //     ->label('Phone')
                //     ->searchable(),
                // TextColumn::make('companies.email')
                //     ->label('Company Email')
                //     ->searchable(),
                // TextColumn::make('companies.cover_photo')
                //     ->label('Cover Photo')
                //     ->searchable(),
                // TextColumn::make('companies.logo')
                //     ->label('Logo')
                //     ->searchable(),
                // TextColumn::make('companies.about')
                //     ->label('About')
                //     ->wrap()
                //     ->lineClamp(2)
                //     ->searchable(),
                // TextColumn::make('companies.Document_Permit')
                //     ->label('Document Permit')
                //     ->searchable(),
                TextColumn::make('companies.isActive')
                    ->label('Is Active')
                    ->searchable(),
                // TextColumn::make('companies.user_handle')
                //     ->label('User Handle')
                //     ->searchable(),
                // TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->modifyQueryUsing(fn($query) => $query->whereHas('companies'))
            ->filters([
                //
            ])
            ->columnManagerColumns(2)
            ->recordActions([
                ViewAction::make()
                    ->button()
                    ->color('primary'),
            ], RecordActionsPosition::BeforeColumns)
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->color('warning')
            ]);
    }
}
