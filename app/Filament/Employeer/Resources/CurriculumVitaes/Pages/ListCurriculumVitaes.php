<?php

namespace App\Filament\Employeer\Resources\CurriculumVitaes\Pages;

use App\Filament\Employeer\Resources\CurriculumVitaes\CurriculumVitaeResource;
use App\Models\CurriculumVitae;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListCurriculumVitaes extends ListRecords
{
    protected static string $resource = CurriculumVitaeResource::class;

    public function mount(): void
    {
        $user = Auth::user();

        // If user is applicant, redirect to edit their own CV
        if ($user && $user->roles()->where('name', env('USER_APPLICANT_ROLE'))->exists()) {
            $cv = CurriculumVitae::where('user_id', $user->id)->first();
            if ($cv) {
                $this->redirect('/Applicants/' . $cv->id . '/edit');
                return;
            } else {
                // If no CV exists, redirect to create page
                $this->redirect(static::getResource()::getUrl('create'));
                return;
            }
        }

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
