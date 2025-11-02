<?php

namespace App\Livewire\Admin\UserList;

use Filament\Actions\BulkActionGroup;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Schemas\Schema;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\CheckboxList;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component implements HasSchemas, HasActions, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public function mount($filter = null): void
    {
        // Check if there's a filter parameter passed from the view or URL
        if ($filter && in_array($filter, ['users_list', 'users_unverified', 'users_verified', 'alumni_verified', 'alumni_unverified', 'alumni_list', 'company_list', 'company_verified', 'company_unverified'])) {
            $this->tableFilters['categories'] = [
                'categories' => [$filter],
            ];
        }
    }
    
    public function table(Table $table): Table
    {
        return $table
            ->query(User::whereHas('curriculumVitae')->orWhere('id', 1))
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('School_id')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('categories')
                    ->form([
                        CheckboxList::make('categories')
                            ->label('Categories')
                            ->options([
                                'users_list' => 'Users List',
                                'users_unverified' => 'Users Unverified',
                                'users_verified' => 'Users Verified',
                                'alumni_list' => 'Alumni List',
                                'alumni_unverified' => 'Alumni Unverified',
                                'alumni_verified' => 'Alumni Verified',
                                'company_list' => 'Company List',
                                'company_unverified' => 'Company Unverified',
                                'company_verified' => 'Company Verified',
                            ])
                            ->columns(1),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        $selected = collect($data['categories'] ?? [])->filter()->values();

                        if ($selected->isEmpty()) {
                            return $query;
                        }

                        return $query->where(function (Builder $q) use ($selected) {
                             // Users List: all users (default, no additional filtering needed)
                             if ($selected->contains('users_list')) {
                                 // No additional query needed - shows all users
                             }

                             // Users Verified: users with non-null email_verified_at
                             if ($selected->contains('users_verified')) {
                                 $q->orWhereNotNull('email_verified_at');
                             }

                             // Users Unverified: users with null email_verified_at
                             if ($selected->contains('users_unverified')) {
                                 $q->orWhereNull('email_verified_at');
                             }

                             // Alumni List: users with a CurriculumVitae record
                            if ($selected->contains('alumni_list')) {
                                $q->orWhereHas('curriculumVitae');
                            }

                            // Alumni Verified: alumni with non-null email_verified_at
                            if ($selected->contains('alumni_verified')) {
                                $q->orWhere(function (Builder $sub) {
                                    $sub->whereNotNull('email_verified_at')
                                        ->whereHas('curriculumVitae');
                                });
                            }

                            // Alumni Unverified: alumni with null email_verified_at
                            if ($selected->contains('alumni_unverified')) {
                                $q->orWhere(function (Builder $sub) {
                                    $sub->whereNull('email_verified_at')
                                        ->whereHas('curriculumVitae');
                                });
                            }

                            // Company List: users with one or more companies
                            if ($selected->contains('company_list')) {
                                $q->orWhereHas('companies');
                            }

                            // Company Verified: per requirement, company list filtered by CurriculumVitae.isAdminVerified = true
                            if ($selected->contains('company_verified')) {
                                $q->orWhere(function (Builder $sub) {
                                    $sub->whereHas('companies')
                                        ->whereHas('curriculumVitae', function (Builder $cv) {
                                            $cv->where('isAdminVerified', true);
                                        });
                                });
                            }

                            // Company Unverified: users with companies and CV not admin verified (false or null)
                            if ($selected->contains('company_unverified')) {
                                $q->orWhere(function (Builder $sub) {
                                    $sub->whereHas('companies')
                                        ->whereHas('curriculumVitae', function (Builder $cv) {
                                            $cv->where(function (Builder $inner) {
                                                $inner->whereNull('isAdminVerified')
                                                     ->orWhere('isAdminVerified', false);
                                            });
                                        });
                                });
                            }
                        });
                    })
                    ->indicateUsing(function (array $data): array {
                        $labels = [
                            'users_list' => 'Users List',
                            'users_unverified' => 'Users Unverified',
                            'users_verified' => 'Users Verified',
                            'alumni_list' => 'Alumni List',
                            'alumni_unverified' => 'Alumni Unverified',
                            'alumni_verified' => 'Alumni Verified',
                            'company_list' => 'Company List',
                            'company_unverified' => 'Company Unverified',
                            'company_verified' => 'Company Verified',
                        ];

                        return collect($data['categories'] ?? [])
                            ->filter()
                            ->map(fn ($key) => $labels[$key] ?? $key)
                            ->values()
                            ->all();
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->form([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('password')->password()->label('New Password')->helperText('Leave blank to keep current password.'),
                        TextInput::make('first_name'),
                        TextInput::make('middle_name'),
                        TextInput::make('last_name'),
                    ])
                    ->action(function (User $record, array $data) {
                        if (!empty($data['password'])) {
                            $data['password'] = Hash::make($data['password']);
                        } else {
                            unset($data['password']);
                        }
                        $record->update($data);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                CreateAction::make()
                    ->form([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('password')->password()->required(),
                        TextInput::make('first_name'),
                        TextInput::make('middle_name'),
                        TextInput::make('last_name'),
                    ])
                    ->action(function (array $data) {
                        $data['password'] = Hash::make($data['password']);
                        User::create($data);
                    }),
            ]);
    }


    public function render()
    {
        return view('livewire.admin.user-list.index');
    }
}
