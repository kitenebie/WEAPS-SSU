<?php

namespace App\Filament\Resources\SystemLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\SystemLog;

class SystemLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(SystemLog::query()->OrderBy('id', 'desc'))
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
                TextColumn::make('model')
                    ->label('Table')
                    ->formatStateUsing(fn($state) => class_basename($state))
                    ->searchable(),
                TextColumn::make('model_id')
                    ->label('Record ID')
                    ->searchable(),
                TextColumn::make('modified')
                    ->label('Changes')
                    ->getStateUsing(fn($record) => $record->modified)
                    ->formatStateUsing(
                        fn($state) =>
                        $state != null
                            ? collect($state)->map(fn($value, $field) => "$field: $value")->join(', ')
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
