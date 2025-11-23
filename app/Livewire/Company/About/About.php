<?php

namespace App\Livewire\Company\About;

use Exception;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Contracts\View\View;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class About extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                RichEditor::make('content')
                    ->label('About Us Content')
                    ->required()
                    ->placeholder('Write about your company here...')
                    ->toolbarButtons([]),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        try {
            $this->form->validate();
        } catch (Exception $e) {
            Notification::make()
                ->title('There were errors with your submission.')
                ->danger()
                ->send();
            throw $e;
        }

        $data = $this->form->getState();

        Auth::user()->companies()->first()->update([
            'about' => $data['content'],
        ]);

        Notification::make()
            ->title('About Us section updated successfully.')
            ->success()
            ->send();
    }
    public function render()
    {
        return view('livewire.company.about.about');
    }
}
