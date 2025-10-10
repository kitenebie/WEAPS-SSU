<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('toggleActive')
                ->label(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isActive', true)->exists();
                    return $hasAnyActive ? 'Deactivate company' : 'Activate company';
                })
                ->requiresConfirmation()
                ->action(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isActive', true)->exists();
                    $newStatus = !$hasAnyActive;
                    $record->companies()->update(['isActive' => $newStatus]);
                })
                ->modalHeading(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isActive', true)->exists();
                    return $hasAnyActive ? 'Deactivate company' : 'Activate company';
                })
                ->modalDescription(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isActive', true)->exists();
                    return $hasAnyActive
                        ? 'Are you sure you\'d like to deactivate this company? This cannot be undone.'
                        : 'Are you sure you\'d like to activate this company? This cannot be undone.';
                })
                ->modalSubmitActionLabel(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isActive', true)->exists();
                    return $hasAnyActive ? 'Yes, deactivate company' : 'Yes, activate company';
                })
                ->visible(fn (User $record) => $record->companies()->exists()),
        ];
    }
}
