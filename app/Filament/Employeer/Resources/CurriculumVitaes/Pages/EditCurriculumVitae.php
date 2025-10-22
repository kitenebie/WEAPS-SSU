<?php

namespace App\Filament\Employeer\Resources\CurriculumVitaes\Pages;

use App\Filament\Employeer\Resources\CurriculumVitaes\CurriculumVitaeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCurriculumVitae extends EditRecord
{
    protected static string $resource = CurriculumVitaeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            // DeleteAction::make(),
        ];
    }
}
