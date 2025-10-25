<?php

namespace App\Livewire\Admin\UserList;

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
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Schemas\Schema;

class Index extends Component implements HasSchemas, HasActions, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;
    
    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('school_id')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add filters if needed
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
