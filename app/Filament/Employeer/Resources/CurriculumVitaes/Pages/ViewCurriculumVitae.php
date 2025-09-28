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
            Action::make('Hire this applicant')
                ->form([
                    TextInput::make('Name')
                        ->required(),
                    TextInput::make('Email')
                        ->required(),
                    Section::make('Send an Email')
                        ->schema([
                            TextInput::make('Subject')
                                ->required(),
                            RichEditor::make('content')
                                ->required()
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['blockquote', 'bulletList', 'orderedList'],
                                    ['table', 'attachFiles'],
                                    ['undo', 'redo'],
                                ]),
                        ])
                ]),
        ];
    }
}
