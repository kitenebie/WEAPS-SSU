<?php

namespace App\Filament\Employeer\Resources\CurriculumVitaes\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Actions\Action;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class CurriculumVitaeForm
{
    public static function getComponents(): array
    {
        return [
            Wizard::make([
                Step::make('Personal Information')
                    ->icon(Heroicon::User)
                    ->completedIcon(Heroicon::CheckCircle)
                    ->description('Basic personal and contact details')
                    ->schema([
                        Grid::make()
                            ->columns(2)
                            ->columnSpanFull()
                            ->schema([
                                FileUpload::make('profile_picture')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1:1',
                                    ])
                                    ->disk('local')
                                    ->directory('profile')
                                    ->visibility('public')
                                    ->image()->columnSpanFull(),
                                TextInput::make('first_name')
                                    ->required(),
                                TextInput::make('last_name')
                                    ->required(),
                                TextInput::make('middle_name')
                                    ->default(null),
                                Select::make('user.gender')
                                    ->label('Gender')
                                    ->options([
                                        'male' => 'Male',
                                        'female' => 'Female',
                                    ]),
                                TextInput::make('email')
                                    ->label('Email address')
                                    ->email()
                                    ->required(),
                                TextInput::make('phone')
                                    ->default(null),
                                TextInput::make('address')->columnSpan(2)
                                    ->default(null),
                                Select::make('user.employment_status')
                                    ->columnSpan(2)
                                    ->label('Employment Status')
                                    ->options([
                                        'employed' => 'Employed',
                                        'unemployed' => 'Unemployed',
                                    ])
                                    ->nullable(),
                            ])
                    ]),
                Step::make('Education & Skills')
                    ->icon(Heroicon::AcademicCap)
                    ->completedIcon(Heroicon::CheckCircle)
                    ->description('Educational qualifications alongside technical and language proficiencies')
                    ->schema([
                        Section::make('Education')
                            // ->collapsed()
                            ->description('Education history and relevant training')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Repeater::make('education')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Education History')
                                    ->schema([
                                        Select::make('degree')
                                            ->label('Degree / Grade')
                                            ->options([
                                                'Elementary School' => 'Elementary School',
                                                'Junior High School' => 'Junior High School',
                                                'Senior High School' => 'Senior High School',
                                                'College' => [
                                                    'BS in Computer Science' => 'BS in Computer Science',
                                                    'BS in Information Technology' => 'BS in Information Technology',
                                                    'BS in Information System' => 'BS in Information System',
                                                    'BS in Accountancy' => 'BS in Accountancy',
                                                    'BS in Accounting Information System' => 'BS in Accounting Information System',
                                                    'BS in Entrepreneurship (BS Entrep)' => 'BS in Entrepreneurship',
                                                    'Bachelor of Public Administration' => 'Bachelor of Public Administration',
                                                ]
                                            ])
                                            ->searchable()
                                            ->required()
                                            ->placeholder('Select or type your degree'),
                                        TextInput::make('school_name')
                                            ->label('School Name / University')
                                            ->required()
                                            ->placeholder('e.g., University of the Philippines'),
                                        TextInput::make('year_graduated')
                                            ->label('Year Graduated')
                                            ->numeric()
                                            ->required()
                                            ->placeholder('e.g., 2020'),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Education')
                            ]),
                        Section::make('Skills & Languages')
                            // ->collapsed()
                            ->description('Technical skills and language proficiencies')
                            ->icon('heroicon-o-language')
                            ->schema([
                                Repeater::make('skills')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Technical & Soft Skills')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->placeholder('e.g., JavaScript, Project Management'),
                                        Select::make('level')
                                            ->options([
                                                10 => 'Beginner',
                                                25 => 'Novice',
                                                40 => 'Intermediate',
                                                60 => 'Advanced',
                                                80 => 'Expert',
                                                95 => 'Master',
                                            ])
                                            ->required()
                                            ->default(40),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Skill'),

                                Repeater::make('languages')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Languages')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->placeholder('Language name'),
                                        Select::make('proficiency')
                                            ->options([
                                                'Basic' => 'Basic',
                                                'Intermediate' => 'Intermediate',
                                                'Fluent' => 'Fluent',
                                                'Native' => 'Native',
                                            ])
                                            ->required()
                                            ->default('Intermediate'),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Language'),
                            ]),
                    ]),
                Step::make('Certifications & Awards')
                    ->icon(Heroicon::Trophy)
                    ->completedIcon(Heroicon::CheckCircle)
                    ->description('Professional certifications and awards received')
                    ->schema([
                        Section::make('certifications')
                            // ->collapsed()
                            // ->description('Technical skills and language proficiencies')
                            ->icon('heroicon-o-document-check')
                            ->schema([
                                Repeater::make('certifications')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Certifications')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->placeholder('Certification name'),
                                        TextInput::make('issuer')
                                            ->required()
                                            ->placeholder('Issuing organization'),
                                        DatePicker::make('date_obtained')
                                            ->required(),
                                        TextInput::make('credential_id')
                                            ->placeholder('Credential ID or number'),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Certification'),
                            ]),
                        Section::make('awards')
                            // ->collapsed()
                            // ->description('Technical skills and language proficiencies')
                            ->icon('heroicon-o-trophy')
                            ->schema([
                                Repeater::make('awards')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Awards & Honors')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->placeholder('Award name'),
                                        TextInput::make('organization')
                                            ->required()
                                            ->placeholder('Granting organization'),
                                        DatePicker::make('date_received')
                                            ->required(),
                                        Textarea::make('description')
                                            ->placeholder('Award details and significance')
                                            ->rows(2),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Award'),
                            ]),
                    ]),
                Step::make('Volunteer Work & References')
                    ->icon(Heroicon::Heart)
                    ->completedIcon(Heroicon::CheckCircle)
                    ->description('Community involvement and professional references')
                    ->schema([
                        Section::make('Volunteer Work')
                            // ->collapsed()
                            ->icon('heroicon-o-heart')
                            ->schema([
                                Repeater::make('volunteer_work')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Volunteer Experience')
                                    ->schema([
                                        TextInput::make('organization')
                                            ->required()
                                            ->placeholder('Organization name'),
                                        TextInput::make('role')
                                            ->required()
                                            ->placeholder('Volunteer role'),
                                        DatePicker::make('start_date')
                                            ->required(),
                                        DatePicker::make('end_date')
                                            ->placeholder('Leave empty if ongoing'),
                                        Textarea::make('description')
                                            ->placeholder('Volunteer activities and contributions')
                                            ->rows(3),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Volunteer Work'),
                            ]),

                        Section::make('References')
                            // ->collapsed()
                            ->icon('heroicon-o-user')
                            ->schema([
                                Repeater::make('references')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Professional References')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->placeholder('Reference person\'s full name'),
                                        TextInput::make('title')
                                            ->required()
                                            ->placeholder('Their professional title'),
                                        TextInput::make('company')
                                            ->placeholder('Their company or organization'),
                                        TextInput::make('email')
                                            ->email()
                                            ->placeholder('Contact email'),
                                        TextInput::make('phone')
                                            ->placeholder('Contact phone'),
                                        TextInput::make('relationship')
                                            ->required()
                                            ->placeholder('Your relationship to this person'),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Reference'),
                            ]),
                    ]),
                Step::make('Professional Summary')
                    ->icon(Heroicon::Briefcase)
                    ->completedIcon(Heroicon::CheckCircle)
                    ->description('Career overview and key qualifications')
                    ->schema([
                        TextInput::make('job_title')
                            ->required()
                            ->default(null),
                        Textarea::make('summary')
                            ->required()
                            ->default(null)
                            ->rows(12)
                            ->columnSpanFull(),
                        TextInput::make('years_of_experience')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),
                Step::make('Others')
                    ->icon(Heroicon::Briefcase)
                    ->completedIcon(Heroicon::CheckCircle)
                    ->description('Supporting details')
                    ->schema([
                        Section::make('Work Experience')
                            // ->collapsed()
                            ->description('Previous job positions and employment history')
                            ->icon('heroicon-o-building-office-2')
                            ->schema([
                                Repeater::make('work_experience')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Work Experience')
                                    ->schema([
                                        TextInput::make('jobPosition')
                                            ->label('Job Position')
                                            ->required(),
                                        DatePicker::make('start_date')
                                            ->label('Start Date')
                                            ->required(),
                                        DatePicker::make('end_date')
                                            ->label('End Date')
                                            ->placeholder('Leave empty if current position'),
                                        TextInput::make('company_name')
                                            ->label('Company Name')
                                            ->required(),
                                        TextInput::make('company_email')
                                            ->label('Company Email'),
                                        TextInput::make('company_contactnumber')
                                            ->label('Company Contact Number'),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Work Experience'),
                            ]),

                        Section::make('Projects')
                            // ->collapsed()
                            ->description('Notable projects and achievements')
                            ->icon('heroicon-o-code-bracket')
                            ->schema([
                                Repeater::make('projects')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Key Projects')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->placeholder('Project name'),
                                        Textarea::make('description')
                                            ->required()
                                            ->placeholder('Project description')
                                            ->rows(3),
                                        TagsInput::make('technologies')
                                            ->placeholder('Technologies used (comma-separated)'),
                                        DatePicker::make('start_date'),
                                        DatePicker::make('end_date'),
                                        Textarea::make('outcomes')
                                            ->placeholder('Project outcomes or impact')
                                            ->rows(2),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Project'),
                            ]),

                        Section::make('Affiliations & Publications')
                            // ->collapsed()
                            ->description('Professional memberships and published works')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Repeater::make('affiliations')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Professional Affiliations')
                                    ->schema([
                                        TextInput::make('organization')
                                            ->required()
                                            ->placeholder('Organization name'),
                                        TextInput::make('role')
                                            ->required()
                                            ->placeholder('Your role or position'),
                                        DatePicker::make('start_date')
                                            ->required(),
                                        DatePicker::make('end_date')
                                            ->placeholder('Leave empty if current'),
                                        Textarea::make('description')
                                            ->placeholder('Role description or contributions')
                                            ->rows(2),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Affiliation'),

                                Repeater::make('publications')
                                    ->addAction(fn(Action $action) => $action->color('primary'))
                                    ->label('Publications')
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->placeholder('Publication title'),
                                        TextInput::make('journal')
                                            ->required()
                                            ->placeholder('Journal or publication name'),
                                        TextInput::make('authors')
                                            ->placeholder('Co-authors (comma-separated)'),
                                        DatePicker::make('publication_date')
                                            ->required(),
                                        TextInput::make('doi')
                                            ->placeholder('DOI or URL'),
                                    ])
                                    ->collapsible()
                                    ->defaultItems(0)
                                    ->addActionLabel('Add Publication'),
                            ]),

                        Section::make('Social Links')
                            // ->collapsed()
                            ->description('Professional online presence')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                TextInput::make('linkedin_url')
                                    ->url()
                                    ->placeholder('https://linkedin.com/in/yourprofile')
                                    ->helperText('LinkedIn profile URL'),
                                TextInput::make('github_url')
                                    ->url()
                                    ->placeholder('https://github.com/yourusername')
                                    ->helperText('GitHub profile URL'),
                                TextInput::make('portfolio_url')
                                    ->url()
                                    ->placeholder('https://yourportfolio.com')
                                    ->helperText('Personal portfolio website URL'),
                                TextInput::make('facebook_url')
                                    ->url()
                                    ->placeholder('https://facebook.com/yourprofile')
                                    ->helperText('Facebook profile URL'),
                            ])
                            ->columns(2),
                    ]),
            ])
                ->skippable()
                ->columnSpanFull()
                ->submitAction(new HtmlString(Blade::render(<<<BLADE
    <x-filament::button
        type="submit"
        size="xl"
        style="color: #ffb900;"
    >
        Save changes
    </x-filament::button>
BLADE)))
        ];
    }
}
