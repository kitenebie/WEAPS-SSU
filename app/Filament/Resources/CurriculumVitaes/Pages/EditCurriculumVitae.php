<?php

namespace App\Filament\Resources\CurriculumVitaes\Pages;

use App\Filament\Resources\CurriculumVitaes\CurriculumVitaeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCurriculumVitae extends EditRecord
{
    protected static string $resource = CurriculumVitaeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        // If isActive changed to true, mark the related user's email as verified now.
        $original = (int) $record->getOriginal('isActive');
        $current = (int) $record->isActive;

        if ($original !== $current && $current === 1) {
            if ($record->user) {
                if ($record->user->email_verified_at === null) {
                    $record->user->forceFill(['email_verified_at' => now()])->save();
                }
            }
        }
    }
}
