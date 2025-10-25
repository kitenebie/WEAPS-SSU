<?php

namespace App\Filament\Employeer\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Facades\Filament;

class Login extends BaseLogin
{
    protected function getRedirectUrl(): string
    {
        $user = Filament::auth()->user();

        if ($user && $user->school_id) {
            return '/alumni/applicant-form';
        }

        return parent::getRedirectUrl();
    }
}