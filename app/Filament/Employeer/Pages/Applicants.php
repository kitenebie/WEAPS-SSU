<?php

namespace App\Filament\Employeer\Pages;

use App\Filament\Widgets\ApplicantStatsWidget;
use App\Models\Applicant;
use App\Models\Company;
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

class Applicants extends Page implements HasTable
{
    use InteractsWithTable;

    public ?string $statusFilter = null;

    protected $listeners = ['filterApplicants' => 'setFilter'];

    protected string $view = 'filament.employeer.pages.applicants';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Folder;
    protected static ?string $navigationLabel = 'Applications';
    protected static ?string $slug = 'applications';
    protected static UnitEnum|string|null $navigationGroup = 'Manage Applicants';

    protected function getHeaderWidgets(): array
    {
        return [
            ApplicantStatsWidget::class,
        ];
    }

    public function setFilter($data)
    {
        $this->statusFilter = $data['status'] ?? null;
        $this->resetTable();
    }

    public function table(Table $table): Table
    {
        $company = Company::where('user_id', Auth::id())->first();

        return $table
            ->query(
                Applicant::query()
                    ->where('company_id', $company ? $company->id : null)
                    ->when($this->statusFilter, fn($query) => $query->where('status', $this->statusFilter))
                    ->with(['user', 'career'])
            )
            ->columns([
                TextColumn::make('user.first_name')
                    ->label('Applicant')
                    ->formatStateUsing(fn($record) => ($record->user->first_name ?? 'Unknown') . ' ' . ($record->user->last_name ?? 'User'))
                    ->searchable(),

                TextColumn::make('career.title')
                    ->label('Position')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Applied')
                    ->since(),

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
                Action::make('view_profile')
                    ->label('View Profile')
                    ->button()
                    ->url(fn($record) =>
                        url('/Applicants/' . (\App\Models\CurriculumVitae::where('user_id', $record->user->id)->first()->id ?? '') . "_blank")
                    )
                    ->color('primary'),

                Action::make('approve')
                    ->label('Approve')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->button()
                    ->color('success')
                    ->modalHeading('Approve Applicant')
                    ->modalDescription(fn($record) => new HtmlString("Are you sure you want to approve <strong>{$record->user->first_name} {$record->user->last_name}</strong>'s application? Please provide a message."))
                    ->form([
                        MarkdownEditor::make('message')->label('Message to Applicant')->required(),
                    ])
                    ->action(fn($record, $data) => [
                        $record->update(['status' => 'approved']),
                        Mail::to($record->user->email)->send(new ApplicantStatusEmail($record, 'approved', $data['message']))
                    ])
                    ->modalCancelAction(false),

                Action::make('reject')
                    ->label('Reject')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->button()
                    ->color('danger')
                    ->modalHeading('Reject Applicant')
                    ->modalDescription(fn($record) => new HtmlString("Are you sure you want to reject <strong>{$record->user->first_name} {$record->user->last_name}</strong>'s application? Please provide a message."))
                    ->form([
                        MarkdownEditor::make('message')->label('Message to Applicant')->required(),
                    ])
                    ->action(fn($record, $data) => [
                        $record->update(['status' => 'rejected']),
                        Mail::to($record->user->email)->send(new ApplicantStatusEmail($record, 'rejected', $data['message']))
                    ])
                    ->modalCancelAction(false),

                Action::make('hire')
                    ->label('Hire Applicant')
                    ->visible(fn($record) => $record->status === 'approved')
                    ->button()
                    ->color('info')
                    ->modalHeading('Hire Applicant')
                    ->modalDescription(fn($record) => new HtmlString("Are you sure you want to hire <strong>{$record->user->first_name} {$record->user->last_name}</strong>? Please provide a message."))
                    ->form([
                        MarkdownEditor::make('message')
                            ->label('Message to Applicant')
                            ->default('Congratulations! You have been hired. Welcome to the team!')
                            ->required(),
                    ])
                    ->action(fn($record, $data) => [
                        $record->update(['status' => 'hired']),
                        Mail::to($record->user->email)->send(new ApplicantStatusEmail($record, 'hired', $data['message']))
                    ])
                    ->modalCancelAction(false),
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
