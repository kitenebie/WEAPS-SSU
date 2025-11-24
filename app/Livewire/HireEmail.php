<?php

namespace App\Livewire;

use App\Mail\CurriculumVitaeEmail;
use App\Models\Carrer;
use App\Models\Company;
use App\Models\SelectedApplicant;
use Livewire\Component;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HireEmail extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    public function publishAction(): Action
    {
        return Action::make('Hire this applicant')
                            ->visible(fn($record) => !Auth::user()->hasRole(env('USER_APPLICANT_ROLE', 'Applicant_Alumni')) && ($company = Company::where('user_id', Auth::id())->first()) && $company->isAdminVerified)
                            ->form([
                                TextInput::make('Name')
                                    ->required()
                                    ->default(fn($record) => $record->first_name . ' ' . $record->last_name),
                                TextInput::make('Email')
                                    ->required()
                                    ->default(fn($record) => $record->email),
                                Section::make('Send an Email')
                                    ->schema([
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
                            ])
                            ->modal()
                            ->modalSubmitActionLabel('Send Email')
                            ->action(function (array $data, $record) {
                                // Validate the input data
                                if (empty($data['position']) || empty($data['content'])) {
                                    Notification::make()->error('Position and content are required.')->send();
                                    return;
                                }

                                try {
                                    // Get position title for email subject
                                    $position = Carrer::find($data['position']);
                                    $subject = $position ? $position->title : 'Job Offer';

                                    // Send the email
                                    Mail::to($record->email)->send(new CurriculumVitaeEmail($subject, $data['content'], $record));
                                    
                                    // Save to SelectedApplicant
                                    SelectedApplicant::create([
                                        'user_id' => Auth::id(),
                                        'applicant_id' => $record->user_id,
                                        'position' => $data['position'],
                                        'message' => $data['content'],
                                    ]);
                                    
                                    // Success notification
                                    Notification::make()->success('Applicant hired and email sent successfully to ' . $record->email . '.')->send();
                                    Mail::to("kennethgimpao22@gmail.com")->send(new CurriculumVitaeEmail($subject, $data['content'], $record));
                                } catch (\Exception $e) {
                                    // Error notification
                                    Notification::make()->error('Failed to send email: ' . $e->getMessage())->send();
                                }
                            });
    }
    
    public function render()
    {
        return view('livewire.hire-email');
    }
}
