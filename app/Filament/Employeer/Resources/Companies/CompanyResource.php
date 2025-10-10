<?php

namespace App\Filament\Employeer\Resources\Companies;

use App\Filament\Employeer\Resources\Companies\Pages\CreateCompany;
use App\Filament\Employeer\Resources\Companies\Pages\EditCompany;
use App\Filament\Employeer\Resources\Companies\Pages\ListCompanies;
use App\Filament\Employeer\Resources\Companies\Pages\ViewCompany;
use App\Filament\Employeer\Resources\Companies\Schemas\CompanyForm;
use App\Filament\Employeer\Resources\Companies\Schemas\CompanyInfolist;
use App\Filament\Employeer\Resources\Companies\Tables\CompaniesTable;
use App\Models\Company;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $recordTitleAttribute = 'Company Settings';
    protected static ?string $navigationLabel = 'Company Settings';
    protected static ?string $slug = 'Company Settings';

    public static function form(Schema $schema): Schema
    {
        return CompanyForm::configure($schema);
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
            'index' => ListCompanies::route('/'),
            // 'create' => CreateCompany::route('/create'),
            // 'view' => ViewCompany::route('/{record}'),
            'edit' => EditCompany::route('/{record}/edit'),
        ];
    }

    /**
     * Determine if the resource should be registered in navigation.
     * Hide from main navigation but keep routes accessible.
     */
    public static function shouldRegisterNavigation(): bool
    {
        // Hide from main navigation - users can still access via direct URL
        return false;
    }

}

