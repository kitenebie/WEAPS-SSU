<?php

namespace App\Filament\Resources\CurriculumVitaes\Pages;

use App\Filament\Resources\CurriculumVitaes\CurriculumVitaeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCurriculumVitae extends ViewRecord
{
    protected static string $resource = CurriculumVitaeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
