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

    // protected function afterSave(): void
    // {
    //     $record = $this->record;

    //     // If isActive changed to true, mark the related user's email as verified now.
    //     $original = (int) $record->getOriginal('isActive');
    //     $current = (int) $record->isActive;

    //     if ($original !== $current && $current === 1) {
    //         if ($record->user) {
    //             if ($record->user->email_verified_at === null) {
    //                 $record->user->forceFill(['email_verified_at' => now()])->save();
    //             }
    //         }
    //     }
    // }
    // Persist nested user attributes from form (user.gender, user.employment_status)
    protected array $userPayload = [];

    /**
     * Prefill nested user fields so Select::make('user.gender') and
     * Select::make('user.employment_status') render current values.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = $this->getRecord()?->user;

        if ($user) {
            $data['user']['gender'] = $user->gender;
            $data['user']['employment_status'] = $user->employment_status;
        }

        return $data;
    }

    /**
     * Extract user.* fields from form data before saving the CurriculumVitae itself.
     * These belong to the related User model, so we remove them from CV payload
     * and persist them in afterSave().
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->userPayload = array_filter([
            'gender' => data_get($data, 'user.gender'),
            'employment_status' => data_get($data, 'user.employment_status'),
        ], fn ($v) => $v !== null && $v !== '');

        // Prevent mass-assignment attempt on CurriculumVitae model
        unset($data['user']);

        return $data;
    }

    /**
     * Persist the extracted user attributes to the related User model.
     */
    protected function afterSave(): void
    {
        if (! empty($this->userPayload) && ($user = $this->record?->user)) {
            $user->fill($this->userPayload)->save();
        }
    }
}
