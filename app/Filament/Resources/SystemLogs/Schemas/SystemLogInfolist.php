<?php

namespace App\Filament\Resources\SystemLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SystemLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('action')
                    ->label('Log Action')
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->color(fn($state) => match (strtolower($state)) {
                        'create' => 'success',
                        'update' => 'warning',
                        'delete' => 'danger',
                        default => 'gray',
                    }),
                    
                TextEntry::make('model')
                    ->label('Table')
                    ->formatStateUsing(fn($state) => class_basename($state)),
                    
                TextEntry::make('model_id')
                    ->label('Record ID'),

                TextEntry::make('modified')
                    ->label('Changes')
                    ->formatStateUsing(
                        fn($state) =>
                        $state != null
                            ? collect($state)->map(fn($value, $field) => "$value"."\n")->join(', ')
                            : 'No changes'
                    )
                    ->wrap(),

                TextEntry::make('user.name')
                    ->label('User')
                    ->formatStateUsing(fn($state) => $state ? $state : 'System'),

                TextEntry::make('ip_address')
                    ->label('Device IP Address'),

                TextEntry::make('created_at')
                    ->label('Logged At')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ]);
    }
}
