<?php

namespace App\Filament\Employeer\Pages;

use Filament\Pages\Page;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\SelectedApplicant;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicantStatusEmail;
use Illuminate\Support\HtmlString;
use BackedEnum;
use UnitEnum;
use Filament\Tables\Filters\SelectFilter;

class SelectedApplicants extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;
    protected static ?string $recordTitleAttribute = 'Selected Applicants';
    protected static ?string $navigationLabel = 'Selected Applicants';
    protected static ?string $slug = 'Selected Applicants';
    protected static UnitEnum|string|null $navigationGroup = 'Manage Applicants';
    protected string $view = 'filament.employeer.pages.selected-applicants';

    public function table(Table $table): Table
    {
        $company = Company::where('user_id', Auth::id())->first();

        return $table
            ->query(SelectedApplicant::whereHas('career', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })->with(['user', 'career']))
            ->columns([
                TextColumn::make('user.first_name')
                    ->label('First Name')
                    ->searchable(),
                TextColumn::make('user.last_name')
                    ->label('Last Name')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('career.title')
                    ->label('Position')
                    ->searchable(),
                TextColumn::make('message')
                    ->label('Message')
                    ->html()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Hired At')
                    ->dateTime(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();
        if (!$user) return false;

        $applicantRole = env('USER_APPLICANT_ROLE');
        if ($user->roles()->where('name', $applicantRole)->exists()) return false;

        $defaultRole = env('USER_DEFAULT_ROLE');
        return !$user->roles()->where('name', $defaultRole)->exists();
    }
}
