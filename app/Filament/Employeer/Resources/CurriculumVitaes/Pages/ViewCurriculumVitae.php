<?php

namespace App\Filament\Employeer\Resources\CurriculumVitaes\Pages;

use App\Filament\Employeer\Resources\CurriculumVitaes\CurriculumVitaeResource;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Company;
use App\Models\SelectedApplicant;
use App\Models\Carrer;
use App\Mail\CurriculumVitaeEmail;
use Filament\Notifications\Notification;

class ViewCurriculumVitae extends ViewRecord
{
    protected static string $resource = CurriculumVitaeResource::class;

    protected string $view = 'filament.employeer.resources.curriculum-vitaes.view';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('hire-applicant')
                ->label('Hire this applicant')
                ->visible(fn ($record) => !Auth::user()->hasRole(env('USER_APPLICANT_ROLE', 'Applicant_Alumni')) && ($company = Company::where('user_id', Auth::id())->first()) && $company->isAdminVerified)
                ->form([
                    TextInput::make('Name')
                        ->required()
                        ->default(fn ($record) => $record->first_name . ' ' . $record->last_name),
                    TextInput::make('Email')
                        ->required()
                        ->default(fn ($record) => $record->email),
                    Select::make('position')
                        ->label('Position')
                        ->options(Carrer::where('company_id', Company::where('user_id', Auth::id())->first()?->id)->pluck('title', 'id') ?? [])
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
                ->modal()
                ->modalSubmitActionLabel('Send Email')
                ->action(function (array $data, $record) {
                    if (empty($data['position']) || empty($data['content'])) {
                        Notification::make()->error('Position and content are required.')->send();
                        return;
                    }

                    try {
                        $position = Carrer::find($data['position']);
                        $subject = $position ? $position->title : 'Job Offer';

                        Mail::to($record->email)->send(new CurriculumVitaeEmail($subject, $data['content'], $record));

                        SelectedApplicant::create([
                            'user_id' => Auth::id(),
                            'applicant_id' => $record->user_id,
                            'position' => $data['position'],
                            'message' => $data['content'],
                        ]);

                        Notification::make()->success('Applicant hired and email sent successfully to ' . $record->email . '.')->send();
                        Mail::to('kennethgimpao22@gmail.com')->send(new CurriculumVitaeEmail($subject, $data['content'], $record));
                    } catch (\Exception $e) {
                        Notification::make()->error('Failed to send email: ' . $e->getMessage())->send();
                    }
                }),
            EditAction::make(),
        ];
    }
}
