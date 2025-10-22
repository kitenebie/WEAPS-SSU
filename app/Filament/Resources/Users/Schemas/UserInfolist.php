<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\URL;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->description('Basic user account details including name and email address')
                    ->columns(2)
                    ->aside()
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('name')->label('Name'),
                        TextEntry::make('email')->label('Email Address'),
                    ]),

                Section::make('Company Details')
                    ->description('Comprehensive company information including business details, contact information, and operational data')
                    ->columns(2)
                    ->aside()
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('company_names')
                            ->label('Company Names')
                            ->state(function ($record) {
                                return $record->companies->pluck('name')->join(', ');
                            }),
                        TextEntry::make('company_types')
                            ->label('Company Types')
                            ->state(function ($record) {
                                return $record->companies->pluck('type')->join(', ');
                            }),
                        TextEntry::make(name: 'company_locations')
                            ->label('Locations')
                            ->state(function ($record) {
                                return $record->companies->pluck('location')->join(', ');
                            }),
                        TextEntry::make('founded_years')
                            ->label('Founded Years')
                            ->state(function ($record) {
                                return $record->companies->pluck('founded_year')->join(', ');
                            }),
                        TextEntry::make('employee_counts')
                            ->label('Employee Counts')
                            ->state(function ($record) {
                                return $record->companies->pluck('employee_count')->join(', ');
                            }),
                        TextEntry::make('industries')
                            ->label('Industries')
                            ->state(function ($record) {
                                return $record->companies->pluck('industry')->join(', ');
                            }),
                        TextEntry::make('company_sizes')
                            ->label('Company Sizes')
                            ->state(function ($record) {
                                return $record->companies->pluck('company_size')->join(', ');
                            }),
                        TextEntry::make('specialties_list')
                            ->label('Specialties')
                            ->state(function ($record) {
                                return $record->companies->pluck('specialties')->flatten()->unique()->join(', ');
                            }),
                        TextEntry::make('websites')
                            ->label('Websites')
                            ->state(function ($record) {
                                return $record->companies->pluck('website')->join(', ');
                            }),
                        TextEntry::make('phones')
                            ->label('Phones')
                            ->state(function ($record) {
                                return $record->companies->pluck('phone')->join(', ');
                            }),
                        TextEntry::make('company_emails')
                            ->label('Company Emails')
                            ->state(function ($record) {
                                return $record->companies->pluck('email')->join(', ');
                            }),
                        TextEntry::make('user_handles')
                            ->label('User Handles')
                            ->state(function ($record) {
                                return $record->companies->pluck('user_handle')->join(', ');
                            }),
                        TextEntry::make('active_status')
                            ->label('Active Status')
                            ->state(function ($record) {
                                $active = $record->companies->where('isActive', true)->count();
                                $total = $record->companies->count();
                                return "{$active}/{$total} active";
                            })
                            ->badge()
                            ->color('success'),
                    ]),

                Section::make('Company Media')
                    ->description('Visual assets including company logos and cover photos for branding and presentation')
                    ->columns(2)
                    ->aside()
                    ->columnSpanFull()
                    ->schema([
                        ImageEntry::make('company_logos')
                            ->label('Company Logos')
                            ->columnSpanFull()
                            ->extraImgAttributes([
                                'alt' => 'Logo',
                                'loading' => 'lazy',
                            ])
                            ->state(function ($record) {
                                return $record->companies->pluck('logo')->filter()->toArray();
                            })
                            ->imageWidth(300)
                            ->imageHeight(300)
                            ->circular(),
                        ImageEntry::make('company_cover')
                            ->label('Company Cover Photo')
                            ->extraImgAttributes([
                                'alt' => 'cover',
                                'loading' => 'lazy',
                            ])
                            ->imageHeight(300)
                            ->columnSpanFull()
                            ->state(function ($record) {
                                return $record->companies->pluck('cover_photo')->filter()->toArray();
                            }),
                        ImageEntry::make('document_permits')
                            ->extraImgAttributes([
                                'alt' => 'permets',
                                'loading' => 'lazy',
                            ])
                            ->imageHeight(500)
                            ->label('Document Permits')
                            ->state(function ($record) {
                                // Collect all the image paths from related companies
                                $paths = $record->companies
                                    ->pluck('Document_Permit')
                                    ->flatten()
                                    ->filter()
                                    ->unique()
                                    ->toArray();

                                // Generate signed URLs for private files
                                return array_map(
                                    fn($path) => URL::temporarySignedRoute(
                                        'private.file',      // route name
                                        now()->addMinutes(5), // expires in 5 mins
                                        ['path' => $path]     // route parameter
                                    ),
                                    $paths
                                );
                            })
                            ->columnSpanFull()
                    ]),

                Section::make('About Companies')
                    ->description('Detailed company descriptions, about information, and legal documentation permits')
                    ->aside()
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('company_abouts')
                            ->label('About Companies')
                            ->state(function ($record) {
                                return $record->companies->pluck('about')->filter()->join('\n\n---\n\n');
                            })
                            ->markdown()
                            ->columnSpanFull(),
                        TextEntry::make('company_descriptions')
                            ->label('Company Descriptions')
                            ->state(function ($record) {
                                return $record->companies->pluck('description')->filter()->join('\n\n---\n\n');
                            })
                            ->markdown()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
