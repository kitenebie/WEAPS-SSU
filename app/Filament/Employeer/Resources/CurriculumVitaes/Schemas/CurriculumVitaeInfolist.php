<?php

namespace App\Filament\Employeer\Resources\CurriculumVitaes\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Company;
use App\Models\SelectedApplicant;
use App\Models\Carrer;
use App\Mail\CurriculumVitaeEmail;
use Filament\Notifications\Notification;

class CurriculumVitaeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Applicant Personal Information')
                    ->description('Personal details provided by the applicant')
                    ->afterHeader([
                        Action::make('Hire this applicant')
                            ->visible(fn($record) => !Auth::user()->hasRole(env('USER_APPLICANT_ROLE', 'Applicant_Alumni')) && Company::where('user_id', Auth::id())->first()->isAdminVerified)
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
                                            ->options(Carrer::where('company_id', Company::where('user_id', Auth::id())->first()->id)->pluck('title', 'id'))
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
                                        'user_id' => $record->user_id,
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
                            }),
                    ])
                    ->schema([
                        Grid::make()
                            ->gridContainer()
                            ->columns([
                                'sm' => 1,
                                'lg' => 2,
                            ])->columnSpanFull()
                            ->schema([
                                Grid::make()
                                    ->columns(1)
                                    ->columnSpanFull()
                                    ->schema([
                                        Section::make('Personal Information')
                                            ->aside()
                                            ->description('Basic personal and contact details')
                                            ->schema([
                                                Grid::make()
                                                    ->columns([
                                                        'sm' => 1,
                                                        'lg' => 3,
                                                    ])
                                                    ->schema([
                                                        Grid::make()
                                                            ->columns(1)
                                                            ->schema([
                                                                ImageEntry::make('profile_picture')
                                                                    ->hiddenLabel()
                                                                    ->disk('local')
                                                                    ->visibility('public')
                                                                    ->imageSize(200)
                                                                    // ->getStateUsing(fn ($state) => $state ?: 'https://static.vecteezy.com/system/resources/previews/024/766/958/non_2x/default-male-avatar-profile-icon-social-media-user-free-vector.jpg'),
                                                            ]),
                                                        Grid::make()
                                                            ->columns(1)
                                                            ->schema([
                                                                TextEntry::make('first_name'),
                                                                TextEntry::make('last_name'),
                                                                TextEntry::make('middle_name'),
                                                            ]),
                                                        Grid::make()
                                                            ->columns(1)
                                                            ->schema([
                                                                TextEntry::make('email')
                                                                    ->label('Email address'),
                                                                TextEntry::make('phone'),
                                                                TextEntry::make('address'),
                                                                TextEntry::make('user.employment_status')
                                                                    ->label('Employment Status')
                                                                    ->formatStateUsing(fn($state) => match ($state) {
                                                                        'employed' => 'Employed',
                                                                        'unemployed' => 'Unemployed',
                                                                        default => 'Unknown',
                                                                    }),
                                                            ]),
                                                    ])
                                            ]),
                                        Section::make('Professional Summary')
                                            ->aside()
                                            ->description('Career overview and key qualifications')
                                            ->icon('heroicon-o-briefcase')
                                            ->schema([
                                                TextEntry::make('job_title'),
                                                TextEntry::make('summary'),
                                                TextEntry::make('years_of_experience'),
                                            ]),
                                        Section::make('Work Experience')
                                            ->aside()
                                            ->description('Previous job positions and employment history')
                                            ->icon('heroicon-o-building-office-2')
                                            ->schema([
                                                RepeatableEntry::make('work_experience')
                                                    ->label('Work Experience')
                                                    ->schema([
                                                        TextEntry::make('jobPosition')->label('Job Position'),
                                                        TextEntry::make('start_date')->label('Start Date'),
                                                        TextEntry::make('end_date')->label('End Date'),
                                                        TextEntry::make('company_name')->label('Company Name'),
                                                        TextEntry::make('company_email')->label('Company Email'),
                                                        TextEntry::make('company_contactnumber')->label('Company Contact Number'),
                                                    ])
                                                    ->columns(2),
                                            ]),
                                        Section::make('Education')
                                            ->aside()
                                            ->description('Education history')
                                            ->icon('heroicon-o-academic-cap')
                                            ->schema([
                                                RepeatableEntry::make('education')
                                                    ->label('Education History')
                                                    ->schema([
                                                        TextEntry::make('degree')->label('Degree / Grade'),
                                                        TextEntry::make('school_name')->label('School Name / University'),
                                                        TextEntry::make('year_graduated')->label('Year Graduated'),
                                                    ])
                                                    ->columns(3)
                                            ]),
                                        Section::make('Projects')
                                            ->aside()
                                            ->description('Notable projects and achievements')
                                            ->icon('heroicon-o-queue-list')
                                            ->schema([
                                                RepeatableEntry::make('projects')
                                                    ->label('Key Projects')
                                                    ->schema([
                                                        TextEntry::make('name'),
                                                        TextEntry::make('description')->columnSpanFull(),
                                                        TextEntry::make('technologies'),
                                                        TextEntry::make('start_date'),
                                                        TextEntry::make('end_date'),
                                                        TextEntry::make('outcomes')->columnSpanFull(),
                                                    ])
                                                    ->columns(2),
                                            ]),
                                    ]),
                                Grid::make()
                                    ->columns(1)
                                    ->schema([
                                        Section::make('Certifications & Awards')
                                            ->aside()
                                            ->description('Professional certifications and awards received')
                                            ->icon('heroicon-o-trophy')
                                            ->schema([
                                                RepeatableEntry::make('certifications')
                                                    ->label('Certifications')
                                                    ->schema([
                                                        TextEntry::make('name'),
                                                        TextEntry::make('issuer'),
                                                        TextEntry::make('date_obtained'),
                                                        TextEntry::make('credential_id'),
                                                    ])
                                                    ->columns(2),
                                                RepeatableEntry::make('awards')
                                                    ->label('Awards & Honors')
                                                    ->schema([
                                                        TextEntry::make('name'),
                                                        TextEntry::make('organization'),
                                                        TextEntry::make('date_received'),
                                                        TextEntry::make('description')->columnSpanFull(),
                                                    ])
                                                    ->columns(2),
                                            ]),
                                        Section::make('Affiliations & Publications')
                                            ->aside()
                                            ->description('Professional memberships and published works')
                                            ->icon('heroicon-o-building-office')
                                            ->schema([
                                                RepeatableEntry::make('affiliations')
                                                    ->label('Professional Affiliations')
                                                    ->schema([
                                                        TextEntry::make('organization'),
                                                        TextEntry::make('role'),
                                                        TextEntry::make('start_date'),
                                                        TextEntry::make('end_date'),
                                                        TextEntry::make('description')->columnSpanFull(),
                                                    ])
                                                    ->columns(2),
                                                RepeatableEntry::make('publications')
                                                    ->label('Publications')
                                                    ->schema([
                                                        TextEntry::make('title'),
                                                        TextEntry::make('journal'),
                                                        TextEntry::make('authors'),
                                                        TextEntry::make('publication_date'),
                                                        TextEntry::make('doi')->columnSpanFull(),
                                                    ])
                                                    ->columns(2)
                                            ]),
                                    ])->columnSpanFull(),
                                Grid::make()
                                    ->columns(1)
                                    ->schema([
                                        Section::make('Skills and Languages')
                                            ->aside()
                                            ->description('Technical skills and languages proficiencies')
                                            ->icon('heroicon-o-light-bulb')
                                            ->schema([
                                                Section::make('Skills')
                                                    ->description('Technical skills proficiencies')
                                                    ->icon('heroicon-o-code-bracket')
                                                    ->schema([
                                                        RepeatableEntry::make('skills')
                                                            ->label('Technical & Soft Skills')
                                                            ->schema([
                                                                TextEntry::make('name'),
                                                                TextEntry::make('level')
                                                                    ->formatStateUsing(fn($state) => match ($state) {
                                                                        10 => 'Beginner',
                                                                        25 => 'Novice',
                                                                        40 => 'Intermediate',
                                                                        60 => 'Advanced',
                                                                        80 => 'Expert',
                                                                        95 => 'Master',
                                                                        default => 'Unknown',
                                                                    }),
                                                            ])->columns(2)
                                                            ->grid(2),
                                                    ])->columnSpanFull(),
                                                Section::make('Languages')
                                                    ->description('language proficiencies')
                                                    ->icon('heroicon-o-language')
                                                    ->schema([
                                                        RepeatableEntry::make('languages')
                                                            ->label('Languages')
                                                            ->schema([
                                                                TextEntry::make('name'),
                                                                TextEntry::make('proficiency'),
                                                            ])->columns(2)
                                                            ->grid(2),
                                                    ])->columnSpanFull(),
                                            ])->columns(2),
                                    ])->columnSpanFull(),

                                Section::make('Volunteer Work & References')
                                    ->aside()
                                    ->description('Community involvement and professional references')
                                    ->icon('heroicon-o-heart')
                                    ->schema([
                                        Grid::make()
                                            ->schema([
                                                RepeatableEntry::make('volunteer_work')
                                                    ->label('Volunteer Work')
                                                    ->schema([
                                                        TextEntry::make('organization'),
                                                        TextEntry::make('role'),
                                                        TextEntry::make('start_date'),
                                                        TextEntry::make('end_date'),
                                                        TextEntry::make('description')->columnSpanFull(),
                                                    ])->columnSpanFull(),
                                                RepeatableEntry::make('references')
                                                    ->label('Professional References')
                                                    ->schema([
                                                        TextEntry::make('name'),
                                                        TextEntry::make('title'),
                                                        TextEntry::make('company'),
                                                        TextEntry::make('email'),
                                                        TextEntry::make('phone'),
                                                        TextEntry::make('relationship')->columnSpanFull(),
                                                    ])->columnSpanFull()->grid(2)->columns(2),
                                            ]),
                                    ])->columnSpanFull(),
                            ]),
                        Section::make('Social Links')
                            ->aside()
                            ->description('Professional online presence')
                            ->icon('heroicon-o-globe-alt')
                            ->columns(4)
                            ->schema([
                                TextEntry::make('linkedin_url')
                                    ->badge()
                                    ->url(fn ($record) => $record->linkedin_url),
                                TextEntry::make('github_url')
                                    ->badge()
                                    ->url(fn ($record) => $record->github_url),
                                TextEntry::make('portfolio_url')
                                    ->badge()
                                    ->url(fn ($record) => $record->portfolio_url),
                                TextEntry::make('facebook_url')
                                    ->badge()
                                    ->url(fn ($record) => $record->facebook_url),
                            ])->columnSpanFull(),
                    ])->columnSpanFull()
            ]);
    }
}
