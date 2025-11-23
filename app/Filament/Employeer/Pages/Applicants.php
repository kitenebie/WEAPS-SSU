<?php

namespace App\Filament\Employeer\Pages;

use App\Filament\Widgets\ApplicantStatsWidget;
use App\Models\Applicant;
use App\Models\Company;
use Filament\Pages\Page;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use UnitEnum;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicantStatusEmail;
use Illuminate\Support\HtmlString;

class Applicants extends Page implements HasTable
{
    use InteractsWithTable;
    protected string $view = 'filament.employeer.pages.applicants';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Folder;
    protected static ?string $recordTitleAttribute = 'Applications';
    protected static ?string $navigationLabel = 'Applications';
    protected static ?string $slug = 'Applications';

    // ⭐ Group in sidebar
    protected static UnitEnum|string|null $navigationGroup = 'Manage Applicants';

    // public static string $resource = CustomerResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            ApplicantStatsWidget::class,
        ];
    }


    public function getColumns(): int | string | array
    {
        return [
            'md' => 2,
            'xl' => 3,
        ];
    }

    public function table(Table $table): Table
    {
        $company = Company::where('user_id', Auth::id())->first();

        return $table
            ->query(
                Applicant::query()
                    ->where('company_id', $company ? $company->id : null)
                    ->with(['user', 'career'])
            )
            ->columns([

                // APPLICANT FULL NAME
                TextColumn::make('user.first_name')
                    ->label('Applicant')
                    ->formatStateUsing(
                        fn($record) => ($record->user->first_name ?? 'Unknown') . ' ' .
                            ($record->user->last_name ?? 'User')
                    )
                    ->searchable(),

                // POSITION
                TextColumn::make('career.title')
                    ->label('Position')
                    ->sortable()
                    ->searchable(),

                // APPLIED DATE
                TextColumn::make('created_at')
                    ->label('Applied')
                    ->since(),

                // STATUS BADGE
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'info' => 'hired',
                        'danger'  => 'rejected',
                    ])
                    ->label('Status')
                    ->formatStateUsing(fn($state) => ucfirst($state)),

            ])
            ->actions([

                // VIEW PROFILE BUTTON
                Action::make('view_profile')
                    ->label('View Profile')
                    ->button()
                    ->url(
                        fn($record) =>
                        url('/Applicants/' . (
                            \App\Models\CurriculumVitae::where('user_id', $record->user->id)->first()->id ?? ''
                        ) . "_blank")
                    )
                    ->color('primary'),

                // APPROVE BUTTON
                Action::make('approve')
                    ->label('Approve')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->button()
                    ->color('success')
                    ->modalHeading('Approve Applicant')
                    ->modalDescription(function ($record) {
                        $name = '<strong>' . e($record->user->first_name . ' ' . $record->user->last_name) . '</strong>';

                        return new HtmlString(
                            "Are you sure you want to approve {$name}'s application? Please provide a message."
                        );
                    })->form([
                        MarkdownEditor::make('message')
                            ->label('Message to Applicant')
                            ->required()
                    ])
                    ->action(function ($record, $data) {
                        $record->update(['status' => 'approved']);
                        Mail::to($record->user->email)->send(new ApplicantStatusEmail($record, 'approved', $data['message']));
                    })
                    ->modalCancelAction(false),

                // REJECT BUTTON
                Action::make('reject')
                    ->label('Reject')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->button()
                    ->color('danger')
                    ->modalHeading('Reject Applicant')
                    ->modalDescription(function ($record) {
                        $name = '<strong>' . e($record->user->first_name . ' ' . $record->user->last_name) . '</strong>';

                        return new HtmlString(
                            "Are you sure you want to reject {$name}'s application? Please provide a message."
                        );
                    })
                    ->form([
                        MarkdownEditor::make('message')
                            ->label('Message to Applicant')
                            ->required()
                    ])
                    ->action(function ($record, $data) {
                        $record->update(['status' => 'rejected']);
                        Mail::to($record->user->email)->send(new ApplicantStatusEmail($record, 'rejected', $data['message']));
                    })
                    ->modalCancelAction(false),

                // HIRED BUTTON
                Action::make('hire')
                    ->label('Hire Applicant')
                    ->visible(fn($record) => $record->status === 'approved')
                    ->button()
                    ->color('info')
                    ->modalHeading('Hire Applicant')
                    ->modalDescription(function ($record) {
                        $name = '<strong>' . e($record->user->first_name . ' ' . $record->user->last_name) . '</strong>';

                        return new HtmlString(
                            "Are you sure you want to hire {$name}? Please provide a message."
                        );
                    })
                    ->form([
                        MarkdownEditor::make('message')
                            ->label('Message to Applicant')
                            ->default('Congratulations! We are pleased to inform you that you have been hired. Welcome to the team!')
                            ->required()
                    ])
                    ->action(function ($record, $data) {
                        $record->update(['status' => 'hired']);
                        Mail::to($record->user->email)->send(new ApplicantStatusEmail($record, 'hired', $data['message']));
                    })
                    ->modalCancelAction(false),


            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        // Hide navigation if user role is applicant
        $applicantRole = env('USER_APPLICANT_ROLE');
        if ($user->roles()->where('name', $applicantRole)->exists()) {
            return false;
        }

        // Fallback logic
        $defaultRole = env('USER_DEFAULT_ROLE');
        return !$user->roles()->where('name', $defaultRole)->exists();
    }
}
