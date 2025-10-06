<?php

namespace App\Filament\Employeer\Resources\CurriculumVitaes\Pages;

use App\Filament\Employeer\Resources\CurriculumVitaes\CurriculumVitaeResource;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;

class ViewCurriculumVitae extends ViewRecord
{
    protected static string $resource = CurriculumVitaeResource::class;

    // protected string $view = 'filament.employeer.resources.curriculum-vitaes.view';

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
