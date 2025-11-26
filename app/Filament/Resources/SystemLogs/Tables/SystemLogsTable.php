<?php

namespace App\Filament\Resources\SystemLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SystemLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('action')
                    ->label('Log Action')
                    ->searchable()
                    ->badge()
                    ->color(fn($state) => match (strtolower($state)) {
                        'create' => 'success',   // green
                        'update' => 'warning',   // yellow
                        'delete' => 'danger',    // red
                        default   => 'gray',     // fallback
                    }),
                TextColumn::make('model_type')
                    ->label('Table')
                    ->formatStateUsing(fn($state) => class_basename($state))
                    ->searchable(),
                TextColumn::make('model_id')
                    ->label('Record')
                    ->getStateUsing(fn($record) => $record->model ? ($record->model->name ?: ($record->model->title ?: ($record->model->email ?: $record->model_id))) : $record->model_id)
                    ->searchable(),
                TextColumn::make('before_changes')
                    ->label('Before')
                    ->getStateUsing(fn($record) => $record->changes)
                    ->formatStateUsing(
                        fn($state) =>
                        $state
                            ? collect($state)->map(fn($change, $field) => "$field: " . ($change['old'] ?? 'N/A'))->join(', ')
                            : 'No changes'
                    )
                    ->wrap(),

                TextColumn::make('after_changes')
                    ->label('After')
                    ->getStateUsing(fn($record) => $record->changes)
                    ->formatStateUsing(
                        fn($state) =>
                        $state
                            ? collect($state)->map(fn($change, $field) => "$field: " . ($change['new'] ?? 'N/A'))->join(', ')
                            : 'No changes'
                    )
                    ->wrap(),

                TextColumn::make('user.name')
                    ->label('User')
                    ->formatStateUsing(fn($state) => $state ? $state : 'System')
                    ->searchable(),
                TextColumn::make('ip_address')
                    ->label('Device IP Address')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Logged At')
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
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
