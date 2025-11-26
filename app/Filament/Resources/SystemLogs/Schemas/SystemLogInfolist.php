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
                TextEntry::make('model'),
                TextEntry::make('model_id')
                    ->numeric(),
                TextEntry::make('action'),
                TextEntry::make('user.name'),
                TextEntry::make('ip_address'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
