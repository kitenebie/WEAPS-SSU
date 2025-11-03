<?php

namespace App\Filament\Resources\CurriculumVitaes\Pages;

use App\Filament\Resources\CurriculumVitaes\CurriculumVitaeResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCurriculumVitae extends CreateRecord
{
    protected static string $resource = CurriculumVitaeResource::class;

    // protected function afterCreate(): void
    // {
    //     $record = $this->record;
    //
    //     // If created with Admin Verified toggled on, set the related user's email as verified now.
    //     if ((int) ($record->isActive ?? 0) === 1 && $record->user) {
    //         if ($record->user->email_verified_at === null) {
    //             $record->user->forceFill(['email_verified_at' => now()])->save();
    //         }
    //     }
    // }

    // Persist nested user attributes from form (user.gender, user.employment_status)
    protected array $userPayload = [];

    /**
     * Extract user.* fields from form data before creating the CurriculumVitae.
     * These belong to the related User model, so we remove them from CV payload
     * and persist them in afterCreate().
     */
    protected function mutateFormDataBeforeCreate(array $data): array
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
     * Persist the extracted user attributes to the related User model after create.
     */
    protected function afterCreate(): void
    {
        /** @var \App\Models\CurriculumVitae|null $record */
        $record = $this->record;

        $user = null;
        if ($record && isset($record->user_id)) {
            $user = \App\Models\User::find($record->user_id);
        }
        if (! $user) {
            $user = Auth::user();
        }

        if (! empty($this->userPayload) && $user instanceof \App\Models\User) {
            $user->fill($this->userPayload)->save();
        }
    }
}
