<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;

class Profile extends Component implements HasForms
{
    use InteractsWithForms;
    public function OpenUpdateCoverPhontoModal()
    {
        $this->dispatch('open-modal',  'edit-campany-cover-photo');
    }
    public function render()
    {
        return view('livewire.company.profile');
    }
}
