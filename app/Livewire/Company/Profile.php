<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class Profile extends Component implements HasForms
{
    use InteractsWithForms;
    public function render()
    {
        return view('livewire.company.profile', [
            'company' => Company::where('user_id', Auth::user()->id)->first(),
        ]);
    }
}
