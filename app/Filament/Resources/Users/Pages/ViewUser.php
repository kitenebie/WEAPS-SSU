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
            Action::make('toggleVerified')
                ->visible(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isActive', true)->exists();
                    if ($hasAnyActive) {
                        return true;
                    }
                    return false;
                })
                ->color(fn(User $record) => $record->companies()->where('isAdminVerified', true)->exists() ? 'danger' : 'success')
                ->label(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isAdminVerified', true)->exists();
                    return $hasAnyActive ? 'restrict to post' : 'Allow to post';
                })
                ->requiresConfirmation()
                ->action(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isAdminVerified', true)->exists();
                    $newStatus = !$hasAnyActive;
                    $record->companies()->update(['isAdminVerified' => $newStatus]);
                })
                ->modalHeading(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isAdminVerified', true)->exists();
                    return $hasAnyActive ? 'restrict to post' : 'Allow to post';
                })
                ->modalDescription(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isAdminVerified', true)->exists();
                    return $hasAnyActive
                        ? 'Are you sure you\'d like to allow to post careers and post blog this company? This cannot be undone.'
                        : 'Are you sure you\'d like to allow to post careers and post blog this company? This cannot be undone.';
                })
                ->modalSubmitActionLabel(function (User $record) {
                    $hasAnyActive = $record->companies()->where('isAdminVerified', true)->exists();
                    return $hasAnyActive ? 'Yes, restrict this company' : 'Yes, allow this company';
                }),
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
                ->color(fn(User $record) => $record->companies()->where('isActive', true)->exists() ? 'danger' : 'success')
                ->visible(fn(User $record) => $record->companies()->exists()),
        ];
    }
}
