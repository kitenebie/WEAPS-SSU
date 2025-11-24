<?php

namespace App\Filament\Employeer\Pages;

use App\Models\Applicant;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use BackedEnum;
use Filament\Actions\Action;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use UnitEnum;

class AppliedJobs extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.employeer.pages.applied-jobs';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::FolderOpen;
    protected static ?string $recordTitleAttribute = 'Applied Jobs';
    protected static ?string $navigationLabel = 'Applied Jobs';
    protected static ?string $slug = 'Applied Jobs';
    protected static UnitEnum|string|null $navigationGroup = 'Manage Application';

    public function table(Table $table): Table
    {
        return $table
            ->query(Applicant::where('user_id', Auth::id())->with(['career.company']))
            ->columns([
                TextColumn::make('career.title')
                    ->label('Job Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('career.company.name')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label('Application Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
                BadgeColumn::make('career.end_date')
                    ->label('Status')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $date = \Carbon\Carbon::parse($state);
                            return $date->isPast() ? 'Expired' : $date->format('M d, Y');
                        } else {
                            return 'N/A';
                        }
                    })
                    ->colors([
                        'info' => 'Expired',
                        'danger' => fn ($state) => $state !== 'Expired' && $state !== 'N/A',
                        'gray' => 'N/A',
                    ])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Applied Date')
                    ->date('M d, Y')
                    ->sortable(),
            ])
            ->actions([
                Action::make('view_details')
                    ->label('View Details')
                    ->button()
                    ->icon('heroicon-o-eye')
                    ->action(function (Applicant $record) {
                        // Placeholder for view details
                        return redirect()->route('filament.employeer.pages.my-application'); // Or appropriate route
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public function getHeaderWidgets(): array
    {
        return [
            StatsOverviewWidget::make([
                Stat::make('Pending Applications', $this->getPendingCount())
                    ->description('Applications waiting for review')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color('warning'),
                Stat::make('Approved Applications', $this->getApprovedCount())
                    ->description('Successfully approved')
                    ->descriptionIcon('heroicon-m-check-circle')
                    ->color('success'),
                Stat::make('Rejected Applications', $this->getRejectedCount())
                    ->description('Applications not approved')
                    ->descriptionIcon('heroicon-m-x-circle')
                    ->color('danger'),
            ]),
        ];
    }

    private function getPendingCount(): int
    {
        return Applicant::where('user_id', Auth::id())->where('status', 'pending')->count();
    }

    private function getApprovedCount(): int
    {
        return Applicant::where('user_id', Auth::id())->where('status', 'approved')->count();
    }

    private function getRejectedCount(): int
    {
        return Applicant::where('user_id', Auth::id())->where('status', 'rejected')->count();
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();
        if (!$user) return false;

        $applicantRole = env('USER_APPLICANT_ROLE');
        if ($user->roles()->where('name', $applicantRole)->exists()) return true;

        $defaultRole = env('USER_DEFAULT_ROLE');
        return !$user->roles()->where('name', $defaultRole)->exists();
    }
}
