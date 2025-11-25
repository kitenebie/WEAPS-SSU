<?php

namespace App\Filament\Employeer\Resources\CurriculumVitaes;

use App\Filament\Employeer\Resources\CurriculumVitaes\Pages\CreateCurriculumVitae;
use App\Filament\Employeer\Resources\CurriculumVitaes\Pages\EditCurriculumVitae;
use App\Filament\Employeer\Resources\CurriculumVitaes\Pages\ListCurriculumVitaes;
use App\Filament\Employeer\Resources\CurriculumVitaes\Pages\ViewCurriculumVitae;
use App\Filament\Employeer\Resources\CurriculumVitaes\Schemas\CurriculumVitaeForm;
use App\Filament\Employeer\Resources\CurriculumVitaes\Schemas\CurriculumVitaeInfolist;
use App\Filament\Employeer\Resources\CurriculumVitaes\Tables\CurriculumVitaesTable;
use App\Models\CurriculumVitae;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Filament\Panel;
use Illuminate\Contracts\Support\Htmlable;

class CurriculumVitaeResource extends Resource
{
    protected static ?string $model = CurriculumVitae::class;

    // protected static string $view = 'filament.employeer.pages.selected-applicants';

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?int $sort = null;

    public static function getNavigationSort(): ?int
    {
        $user = Auth::user();
        if ($user && $user->roles()->where('name', env('USER_APPLICANT_ROLE'))->exists()) {
            return -20;
        }
        return null;
    }
    public static function getModelLabel(): string
    {
        $user = Auth::user();
        if ($user && $user->roles()->where('name', env('USER_APPLICANT_ROLE'))->exists()) {
            return 'Edit Profile';
        }
        return 'Applicants';
    }


    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        $user = Auth::user();
        if ($user && $user->roles()->where('name', env('USER_APPLICANT_ROLE'))->exists()) {
            $user->syncRoles([env('USER_APPLICANT_ROLE')]);
            $user->assignRole(env('USER_APPLICANT_ROLE'));
            return  Heroicon::PencilSquare;
        }
        return  Heroicon::OutlinedUserGroup;
    }


    protected static ?string $recordTitleAttribute = 'first_name';

    public static function getNavigationLabel(): string
    {
        $user = Auth::user();
        if ($user && $user->roles()->where('name', env('USER_APPLICANT_ROLE'))->exists()) {
            $user->syncRoles([env('USER_APPLICANT_ROLE')]);
            $user->assignRole(env('USER_APPLICANT_ROLE'));
            return 'Edit Profile';
        }
        return 'Recruiting Applicants';
    }

    protected static ?string $slug = 'Applicants';

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->fullname;
    }

    public static function getClusterBreadcrumb(): string
    {
        $user = Auth::user();
        if ($user && $user->roles()->where('name', env('USER_APPLICANT_ROLE'))->exists()) {
            return 'My Profile';
        }
        return 'Applicants';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(CurriculumVitaeForm::getComponents());
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

    protected static function getIndexRedirectUrl(): string
    {
        // This is now handled in ListCurriculumVitaes::mount()
        // Keeping as fallback for other scenarios
        return static::getUrl('index');
    }
}
