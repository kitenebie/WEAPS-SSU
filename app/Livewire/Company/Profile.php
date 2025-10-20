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
use Illuminate\Support\Facades\Session;

class Profile extends Component implements HasForms
{
    use InteractsWithForms;
    public function render()
    {
        if(Session::get('company_id')){
            $company = Company::find(Session::get('company_id'));
        } else {
            $company = Company::where('user_id', Auth::user()->id)->first();
        }

        // Track visitor if not the company owner
        if ($company && Auth::check() && Auth::user()->id !== $company->user_id) {
            \App\Models\RecentVisitor::updateOrCreate(
                [
                    'visitor_id' => Auth::user()->id,
                    'profile_id' => $company->user_id,
                ],
                [
                    'visited_at' => now(),
                ]
            );
        }

        return view('livewire.company.profile', [
            'company' => $company,
        ]);
    }
}
