<?php

namespace App\Filament\Resources\CurriculumVitaes\Pages;

use App\Filament\Resources\CurriculumVitaes\CurriculumVitaeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCurriculumVitaes extends ListRecords
{
    protected static string $resource = CurriculumVitaeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
