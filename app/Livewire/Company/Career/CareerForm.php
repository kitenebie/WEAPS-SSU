<?php

namespace App\Livewire\Company\Career;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Schemas\Components\Grid;

class CareerForm
{
    public static function make(): array
    {
        return [
            Grid::make()
                ->columns([
                    'default' => 3,
                    'sm' => 1,
                ])
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columns(1),
                    Select::make('role_type')
                        ->options([
                            'Full-time' => 'Full-time',
                            'Part-time' => 'Part-time',
                            'Contract' => 'Contract',
                            'Internship' => 'Internship',
                            'Freelance' => 'Freelance',
                        ])
                        ->required(),
                    TextInput::make('location')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('min_salary')
                        ->label('Minimum Salary (₱)')
                        ->prefix('₱')
                        ->numeric()
                        ->required(),
                    TextInput::make('max_salary')
                        ->label('Maximum Salary (₱)')
                        ->prefix('₱')
                        ->numeric()
                        ->required(),
                    TagsInput::make('tags')
                        ->color('danger')
                        ->placeholder('Add skills or tags'),
                    DatePicker::make('start_date')
                        ->label('Start Date'),
                    DatePicker::make('end_date')
                        ->label('End Date'),
                    Textarea::make('description')
                        ->required()
                        ->rows(8)
                        ->columnSpanFull(),
                ])
        ];
    }
}
