<?php

namespace App\Filament\Resources\CurriculumVitaes\Pages;

use App\Filament\Resources\CurriculumVitaes\CurriculumVitaeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCurriculumVitae extends CreateRecord
{
    protected static string $resource = CurriculumVitaeResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;

        // If created with Admin Verified toggled on, set the related user's email as verified now.
        if ((int) ($record->isActive ?? 0) === 1 && $record->user) {
            if ($record->user->email_verified_at === null) {
                $record->user->forceFill(['email_verified_at' => now()])->save();
            }
        }
    }
}
