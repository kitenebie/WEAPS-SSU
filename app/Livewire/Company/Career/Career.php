<?php

namespace App\Livewire\Company\Career;

use App\Livewire\Company\Career\CareerForm;
use App\Models\Carrer;
use Filament\Actions\BulkAction;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Filament\Forms\FormsComponent;
use Filament\Schemas\Schema;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;

class Career extends Component implements HasSchemas, HasTable, HasActions
{
    use InteractsWithSchemas;
    use InteractsWithTable;
    use InteractsWithActions;
    public function table(Table $table): Table
    {
        return $table
            ->query(Carrer::where('company_id', Auth::user()->companies()->first()->id ?? null))
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role_type')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('min_salary')
                    ->money('PHP')
                    ->sortable(),
                TextColumn::make('max_salary')
                    ->money('PHP')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->form(CareerForm::make())
            ])
            ->toolbarActions([
                    BulkAction::make('Delete')
                        ->action(function (array $records) {
                            foreach ($records as $record) {
                                $record->delete();
                            }
                        })
                        ->requiresConfirmation()
                        ->color('danger')
                        ->icon('heroicon-o-trash'),
                CreateAction::make()
                    ->form(CareerForm::make())
                    ->action(function (array $data) {
                        $data['company_id'] = Auth::user()->companies()->first()->id;
                        Carrer::create($data);
                    }),
            ]);
    }


    public function render()
    {
        return view('livewire.company.career.career');
    }
}
