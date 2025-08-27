<?php

namespace App\Filament\Resources\CurriculumVitaes;

use App\Filament\Resources\CurriculumVitaes\Pages\CreateCurriculumVitae;
use App\Filament\Resources\CurriculumVitaes\Pages\EditCurriculumVitae;
use App\Filament\Resources\CurriculumVitaes\Pages\ListCurriculumVitaes;
use App\Filament\Resources\CurriculumVitaes\Pages\ViewCurriculumVitae;
use App\Filament\Resources\CurriculumVitaes\Schemas\CurriculumVitaeForm;
use App\Filament\Resources\CurriculumVitaes\Schemas\CurriculumVitaeInfolist;
use App\Filament\Resources\CurriculumVitaes\Tables\CurriculumVitaesTable;
use App\Models\CurriculumVitae;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CurriculumVitaeResource extends Resource
{
    protected static ?string $model = CurriculumVitae::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Curriculum Vitae';

    public static function form(Schema $schema): Schema
    {
        return CurriculumVitaeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CurriculumVitaeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurriculumVitaesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCurriculumVitaes::route('/'),
            'create' => CreateCurriculumVitae::route('/create'),
            'view' => ViewCurriculumVitae::route('/{record}'),
            'edit' => EditCurriculumVitae::route('/{record}/edit'),
        ];
    }
}
