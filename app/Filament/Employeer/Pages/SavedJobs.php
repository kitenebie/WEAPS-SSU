<?php

namespace App\Filament\Employeer\Pages;

use App\Models\SaveCareer;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Actions\Action;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use BackedEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use UnitEnum;

class SavedJobs extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.employeer.pages.saved-jobs';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Bookmark;
    protected static ?string $recordTitleAttribute = 'Saved Jobs';
    protected static ?string $navigationLabel = 'Saved Jobs';
    protected static ?string $slug = 'Saved Jobs';
    protected static UnitEnum|string|null $navigationGroup = 'Manage Application';

    public function table(Table $table): Table
    {
        return $table
            ->query(SaveCareer::where('user_id', Auth::id())->with(['career.company']))
            ->columns([
                TextColumn::make('career.title')
                    ->label('Job Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('career.company.name')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),
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
                        'danger' => 'Expired',
                    ])
                    ->sortable(),
            ])
            ->actions([
                Action::make('view_details')
                    ->label('View Details')
                    ->icon('heroicon-o-eye')
                    ->button()
                    ->action(function (SaveCareer $record) {
                        // Placeholder for view details
                        // You can redirect or open modal here
                        return redirect()->route('filament.employeer.pages.my-application'); // Or appropriate route
                    }),
                Action::make('remove')
                    ->button()
                    ->label('Remove')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (SaveCareer $record) => $record->delete()),
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
