<?php

namespace App\Filament\Employeer\Resources\Companies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use App\Models\Company;
use App\Models\Carrer;
use App\Models\CompanyPost;
use Illuminate\Support\Facades\Auth;

class CompanyForm
{
    private static function getCompanyId(): ?int
    {
        static $companyId = null;

        if ($companyId !== null) {
            return $companyId;
        }

        $record = request()->route('record');

        if ($record && $record instanceof Company) {
            $companyId = $record->id;
        } elseif (is_array($record) && isset($record['id'])) {
            $companyId = $record['id'];
        } elseif (request()->has('record') && is_numeric(request('record'))) {
            $companyId = request('record');
        }

        return $companyId;
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Company Information')
                    ->columnSpanFull()
                    ->collapsed()
                    ->collapsible()
                    ->description('Complete company profile and details')
                    ->components([
                        Section::make('Media & Branding')
                            ->aside()
                            ->description('Company visual assets and branding')
                            ->columns(2)
                            ->components([
                                FileUpload::make('logo')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1:1',
                                    ])
                                    ->default(null)->required()->image(),
                                FileUpload::make('cover_photo')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                    ])
                                    ->default(null)->required()->image(),
                            ]),

                        Section::make('Basic Information')
                            ->aside()
                            ->description('Core company details and overview')
                            ->columns(2)
                            ->components([
                                TextInput::make('id')
                                    ->required(),
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('type')
                                    ->default(null)->required(),
                                TextInput::make('location')
                                    ->default(null)->required(),
                                TextInput::make('founded_year')
                                    ->numeric()
                                    ->default(null)->required(),
                                TextInput::make('employee_count')
                                    ->numeric()
                                    ->default(null)->required(),
                                Textarea::make('description')
                                    ->default(null)->required()
                                    ->columnSpanFull(),
                                Textarea::make('about')->label('Company Summary')
                                    ->default(null)->required()
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Industry & Classification')
                            ->aside()
                            ->description('Company industry and business details')
                            ->columns(2)
                            ->components([
                                TextInput::make('industry')
                                    ->default(null)->required(),
                                TextInput::make('company_size')
                                    ->default(null)->required(),
                                TagsInput::make('specialties')
                                    ->default(null)->required()
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Contact Information')
                            ->aside()
                            ->description('How to reach and connect with the company')
                            ->columns(2)
                            ->components([
                                TextInput::make('website')
                                    ->default(null)->required(),
                                TextInput::make('phone')
                                    ->tel()
                                    ->default(null)->required(),
                                TextInput::make('email')
                                    ->label('Email address')
                                    ->email()
                                    ->default(null)->required(),
                            ]),
                    ]),

                Section::make('Career Management')
                    ->collapsed()
                    ->collapsible()
                    ->columnSpanFull()
                    ->description('Job positions and career opportunities')
                    ->components([
                        Repeater::make('careers')
                            ->label('Career Positions')
                            ->schema([
                                Hidden::make('company_id')
                                    ->default(fn() => static::getCompanyId()),
                                TextInput::make('title')
                                    ->label('Job Title')
                                    ->required()
                                    ->columnSpanFull(),
                                Textarea::make('description')
                                    ->label('Job Description')
                                    ->required()
                                    ->columnSpanFull()
                                    ->rows(3),
                                Select::make('role_type')
                                    ->label('Role Type')
                                    ->options([
                                        'Full-time' => 'Full-time',
                                        'Part-time' => 'Part-time',
                                        'Contract' => 'Contract',
                                        'Internship' => 'Internship',
                                        'Freelance' => 'Freelance',
                                    ])
                                    ->required(),
                                TextInput::make('location')
                                    ->label('Job Location')
                                    ->required(),
                                TagsInput::make('tags')
                                    ->label('Skills/Tags')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->default([])
                            ->addActionLabel('Add New Career Position')
                            ->itemLabel(fn(array $state): ?string => $state['title'] ?? null),
                    ]),

                Section::make('Company Posts')
                    ->columnSpanFull()
                    ->collapsed()
                    ->collapsible()
                    ->description('Company announcements and updates')
                    ->components([
                        Repeater::make('posts')
                            ->label('Company Posts')
                            ->schema([
                                Hidden::make('id')->default(null), // For existing records
                                Hidden::make('company_id')
                                    ->default(fn() => static::getCompanyId()),
                                Textarea::make('content')
                                    ->label('Post Content')
                                    ->required()
                                    ->columnSpanFull()
                                    ->rows(4)
                                    ->placeholder('Write your company announcement or update...'),
                            ])
                            ->columns(1)
                            ->columnSpanFull()
                            ->default([])
                            ->addActionLabel('Add New Post')
                            ->itemLabel(
                                fn(array $state): ?string =>
                                strlen($state['content'] ?? '') > 30
                                    ? substr($state['content'], 0, 30) . '...'
                                    : ($state['content'] ?? 'New Post')
                            ),
                    ]),

            ]);
    }
}
