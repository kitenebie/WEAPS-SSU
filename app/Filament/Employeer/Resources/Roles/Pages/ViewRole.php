<?php

declare(strict_types=1);

namespace App\Filament\Employeer\Resources\Roles\Pages;

use App\Filament\Employeer\Resources\Roles\RoleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRole extends ViewRecord
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
