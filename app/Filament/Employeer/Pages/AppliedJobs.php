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
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
                TextColumn::make('created_at')
                    ->label('Applied Date')
                    ->date('M d, Y')
                    ->sortable(),
            ])
            ->actions([
                Action::make('view_details')
                    ->label('View Details')
                    ->icon('heroicon-o-eye')
                    ->action(function (Applicant $record) {
                        // Placeholder for view details
                        return redirect()->route('filament.employeer.pages.my-application'); // Or appropriate route
                    }),
            ])
            ->defaultSort('created_at', 'desc');
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
