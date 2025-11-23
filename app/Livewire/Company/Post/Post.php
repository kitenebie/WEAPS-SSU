<?php

namespace App\Livewire\Company\Post;

use App\Models\CompanyPost;
use Filament\Actions\BulkAction;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Post extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CompanyPost::where('company_id', Auth::user()->companies()->first()->id ?? null))
            ->columns([
                TextColumn::make('content')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
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
                    ->form([
                        Textarea::make('content')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
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
                    ->form([
                        Textarea::make('content')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull()
                            ->placeholder('Write your company announcement or update...'),
                    ])
                    ->action(function (array $data) {
                        $data['company_id'] = Auth::user()->companies()->first()->id;
                        CompanyPost::create($data);
                    }),
            ]);
    }

    public function render()
    {
        return view('livewire.company.post.post');
    }
}