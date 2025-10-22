<?php

namespace App\Filament\Resources\CurriculumVitaes\Schemas;


use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class CurriculumVitaeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Grid::make()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        Grid::make()
                            ->schema([
                                Section::make('Personal Information')
                                    ->collapsed()
                                    ->description('Basic personal and contact details')
                                    ->icon('heroicon-o-user')
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
                                        TextInput::make('email')
                                            ->label('Email address')
                                            ->email()
                                            ->required(),
                                        TextInput::make('phone')
                                            ->tel()->columnSpan(2)
                                            ->default(null),
                                        TextInput::make('address')->columnSpan(2)
                                            ->default(null),
                                    ])
                                    ->columns(2),

                                Section::make('Education & Skills')
                                    ->collapsed()
                                    ->description('Educational qualifications alongside technical and language proficiencies')
                                    ->icon('heroicon-o-light-bulb')
                                    ->schema([
                                        Section::make('Education')
                                            ->collapsed()
                                            ->description('Education history and relevant training')
                                            ->icon('heroicon-o-academic-cap')
                                            ->schema([
                                                Repeater::make('education')
                                                    ->label('Education History')
                                                    ->schema([
                                                        TextInput::make('degree')
                                                            ->label('Degree / Grade')
                                                            ->required()
                                                            ->placeholder('e.g., Bachelor of Science in Computer Science'),
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
                                            ->collapsed()
                                            ->description('Technical skills and language proficiencies')
                                            ->icon('heroicon-o-language')
                                            ->schema([
                                                Repeater::make('skills')
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


                                Section::make('Certifications & Awards')
                                    ->collapsed()
                                    ->description('Professional certifications and awards received')
                                    ->icon('heroicon-o-trophy')
                                    ->schema([
                                        Repeater::make('certifications')
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

                                        Repeater::make('awards')
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

                                Section::make('Volunteer Work & References')
                                    ->collapsed()
                                    ->description('Community involvement and professional references')
                                    ->icon('heroicon-o-heart')
                                    ->schema([
                                        Repeater::make('volunteer_work')
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

                                        Repeater::make('references')
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
                            ])->columnSpanFull(),
                        Grid::make()
                            ->schema([
                                Section::make('Professional Summary')
                                    ->collapsed()
                                    ->description('Career overview and key qualifications')
                                    ->icon('heroicon-o-briefcase')
                                    ->schema([
                                        TextInput::make('job_title')
                                            ->default(null),
                                        Textarea::make('summary')
                                            ->default(null)
                                            ->rows(4)
                                            ->columnSpanFull(),
                                        TextInput::make('years_of_experience')
                                            ->required()
                                            ->numeric()
                                            ->default(0),
                                    ]),

                                Section::make('Work Experience')
                                    ->collapsed()
                                    ->description('Previous job positions and employment history')
                                    ->icon('heroicon-o-building-office-2')
                                    ->schema([
                                        Repeater::make('work_experience')
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
                                    ->collapsed()
                                    ->description('Notable projects and achievements')
                                    ->icon('heroicon-o-code-bracket')
                                    ->schema([
                                        Repeater::make('projects')
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
                                    ->collapsed()
                                    ->description('Professional memberships and published works')
                                    ->icon('heroicon-o-building-office')
                                    ->schema([
                                        Repeater::make('affiliations')
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
                                    ->collapsed()
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
                                Section::make('Admin Verification')
                                    ->collapsed()
                                    ->description('Administrative verification status')
                                    ->icon('heroicon-o-shield-check')
                                    ->schema([
                                        Toggle::make('isAdminVerified')
                                            ->label('Admin Verified')
                                            ->onIcon(Heroicon::ShieldCheck)
                                            ->offIcon(Heroicon::Power)
                                            ->helperText('Indicates if this CV has been verified by an administrator'),
                                        Toggle::make('isAiValidate')
                                            ->onIcon(Heroicon::Sparkles)
                                            ->offIcon(Heroicon::ArrowPath)
                                            ->label('AI Validated')
                                            ->helperText('Indicates if this User has been validated by AI processes'),
                                    ])
                                    ->columns(2),
                            ])->columnSpanFull()
                    ])
            ]);
    }
}
