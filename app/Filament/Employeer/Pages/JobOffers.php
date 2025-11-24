<?php

namespace App\Filament\Employeer\Pages;
use App\Models\Applicant;
use App\Models\SelectedApplicant;
use Filament\Pages\Page;
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

class JobOffers extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.employeer.pages.job-offers';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Briefcase;
    protected static ?string $recordTitleAttribute = 'Job Offers';
    protected static ?string $navigationLabel = 'Job Offers';
    protected static ?string $slug = 'Job Offers';
    protected static UnitEnum|string|null $navigationGroup = 'Manage Application';

    public function table(Table $table): Table
    {
        return $table
            ->query(SelectedApplicant::whereHas('applicant', function ($query) {
                $query->where('user_id', Auth::id());
            })->with(['user', 'applicant.career']))
            ->columns([
                TextColumn::make('applicant.company.name')
                    ->label('Company')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('applicant.career.title')
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

        $applicantRole = env('USER_EMPLOYEER_ROLE');
        if ($user->roles()->where('name', $applicantRole)->exists()) return false;

        $defaultRole = env('USER_DEFAULT_ROLE');
        return !$user->roles()->where('name', $defaultRole)->exists();
    }
}

