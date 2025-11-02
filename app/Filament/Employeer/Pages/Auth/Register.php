<?php

namespace App\Filament\Employeer\Pages\Auth;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Auth\Pages\Register as BaseRegister;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Filament\Facades\Filament;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\Hidden;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Register extends BaseRegister
{
    public $registerMode = 'normal';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('School_id')
                    ->label('Student ID')
                    ->maxLength(255)
                    ->required(fn () => $this->registerMode === 'student')
                    ->visible(fn () => $this->registerMode != 'normal'),

                TextInput::make('name')
                    ->label(__('filament-panels::auth/pages/register.form.name.label'))
                    ->required(fn () => $this->registerMode === 'normal')
                    ->maxLength(255)
                    ->autofocus()
                    ->visible(fn () => $this->registerMode === 'normal'),

                TextInput::make('email')
                    ->label(__('filament-panels::auth/pages/register.form.email.label'))
                    ->email()
                    ->required(fn () => $this->registerMode === 'normal')
                    ->maxLength(255)
                    ->unique(table: 'users')
                    ->visible(fn () => $this->registerMode === 'normal'),

                TextInput::make('password')
                    ->label(__('filament-panels::auth/pages/register.form.password.label'))
                    ->password()
                    ->required(fn () => $this->registerMode === 'normal')
                    ->minLength(8)
                    ->same('passwordConfirmation'),

                TextInput::make('passwordConfirmation')
                    ->label(__('filament-panels::auth/pages/register.form.password_confirmation.label'))
                    ->password()
                    ->required(fn () => $this->registerMode === 'normal'),
                Placeholder::make('social_auth')
                    ->hiddenLabel()
                    ->visible(fn () => $this->registerMode === 'normal')
                    ->content(new \Illuminate\Support\HtmlString('
                    <div style="display: flex; flex-direction:  column; margin-bottom: 1rem; gap: 8px;">
                    <button style="Display: flex !important" x-data="filamentFormButton" x-bind:class="{ \'fi-processing\': isProcessing }" class="btn-signup mb-4 fi-color fi-color-primary fi-bg-color-600 hover:fi-bg-color-500 dark:fi-bg-color-600 dark:hover:fi-bg-color-500 fi-text-color-0 hover:fi-text-color-0 dark:fi-text-color-0 dark:hover:fi-text-color-0 fi-btn fi-size-md  fi-ac-btn-action" type="submit" wire:loading.attr="disabled" wire:target="register" x-bind:disabled="isProcessing">
                                            <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fi-icon fi-loading-indicator fi-size-md" wire:loading.delay.default="" wire:target="register">
    <path clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
</svg>                <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fi-icon fi-loading-indicator fi-size-md" x-show="isProcessing" style="display: none;">
    <path clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
</svg>
                                                <span x-show="! isProcessing">
                        Sign up                    </span>

                            <span x-show="isProcessing" x-text="processingMessage" style="display: none;"></span>


                    </button>
                    </div>
                        <p style="width: 100%; margin-bottom: 1rem; text-align:center; padding: 4px; color: #A4A4A4">--------------  Or continue with  --------------</p>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <button style="Display: flex !important" wire:click="$set(\'registerMode\', \'student\')" class="btn-signup mb-4 fi-color fi-color-primary fi-bg-color-600 hover:fi-bg-color-500 dark:fi-bg-color-600 dark:hover:fi-bg-color-500 fi-text-color-0 hover:fi-text-color-0 dark:fi-text-color-0 dark:hover:fi-text-color-0 fi-btn fi-size-md  fi-ac-btn-action" type="button">
                        Register Using SorSU ID
                    </button>

                            <a href="' . route('socialite.google') . '" style="display: inline-flex ; align-items: center; justify-content: center; padding: 8px 16px; background-color: #0866FF; border: 1px solid #0247AFFF; border-radius: 6px; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); font-size: 14px; font-weight: 500; color: #EBEBEBFF; text-decoration: none;">
                                <svg style="width: 20px; height: 20px; margin-right: 8px;" viewBox="0 0 24 24">
                                    <path fill="#EBEBEBFF" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#EBEBEBFF" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#EBEBEBFF" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EBEBEBFF" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                Continue with Google
                            </a>
                            <a href="' . route('socialite.github') . '" style="display: inline-flex; align-items: center; justify-content: center; padding: 8px 16px; background-color: #1f2937; border: 1px solid transparent; border-radius: 6px; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); font-size: 14px; font-weight: 500; color: white; text-decoration: none;">
                                <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                                Continue with GitHub
                            </a>
                            <a href="' . route('socialite.linkedin') . '" style="display: inline-flex; align-items: center; justify-content: center; padding: 8px 16px; background-color: #0077B5; border: 1px solid transparent; border-radius: 6px; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); font-size: 14px; font-weight: 500; color: white; text-decoration: none;">
                                <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                                Continue with LinkedIn
                            </a>
                        </div>
                        <style>
                        button:nth-child(1)
                        {
                            display: none !important;
                        }
                        btn-signup
                        {
                            display: flex !important;
                        }

                        </style>
                    ')),
                Placeholder::make('social_auth')
                    ->hiddenLabel()
                    ->visible(fn () => $this->registerMode === 'student')
                    ->content(new \Illuminate\Support\HtmlString('
                    <div style="display: flex; flex-direction:  column; margin-bottom: 1rem; gap: 8px;">
                    <button style="Display: flex !important" x-data="filamentFormButton" x-bind:class="{ \'fi-processing\': isProcessing }" class="btn-signup mb-4 fi-color fi-color-primary fi-bg-color-600 hover:fi-bg-color-500 dark:fi-bg-color-600 dark:hover:fi-bg-color-500 fi-text-color-0 hover:fi-text-color-0 dark:fi-text-color-0 dark:hover:fi-text-color-0 fi-btn fi-size-md  fi-ac-btn-action" type="submit" wire:loading.attr="disabled" wire:target="register" x-bind:disabled="isProcessing">
                                            <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fi-icon fi-loading-indicator fi-size-md" wire:loading.delay.default="" wire:target="register">
    <path clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
</svg>                <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fi-icon fi-loading-indicator fi-size-md" x-show="isProcessing" style="display: none;">
    <path clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
</svg>
                                                <span x-show="! isProcessing">
                        Sign up                    </span>

                            <span x-show="isProcessing" x-text="processingMessage" style="display: none;"></span>


                    </button>
                    </div>
                        <p style="width: 100%; margin-bottom: 1rem; text-align:center; padding: 4px; color: #A4A4A4">--------------  Or continue with  --------------</p>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                        
                            <button style="Display: flex !important" wire:click="$set(\'registerMode\', \'normal\')" class="btn-signup mb-4 fi-color fi-color-primary fi-bg-color-600 hover:fi-bg-color-500 dark:fi-bg-color-600 dark:hover:fi-bg-color-500 fi-text-color-0 hover:fi-text-color-0 dark:fi-text-color-0 dark:hover:fi-text-color-0 fi-btn fi-size-md  fi-ac-btn-action" type="button">
                        Try another way
                    </button>
                        </div>
                        <style>
                        button:nth-child(1)
                        {
                            display: none !important;
                        }
                        btn-signup
                        {
                            display: flex !important;
                        }

                        </style>
                    
                    
                    
                    
                    ')),
            ]);
    }

    public function register(): ?RegistrationResponse
    {
        $data = $this->form->getState();
        if (!empty($data['School_id'])) {
            $existingUser = User::where('School_id', $data['School_id'])->first();
            // dd($data);
            if ($existingUser) {
                Session::put('Alumni_data', $existingUser);
                $updateData = [];
                if (isset($data['email'])) {
                    $updateData['email'] = $data['email'];
                }
                $updateData['password'] = Hash::make($data['password']);
                $existingUser->update($updateData);
                Filament::auth()->login($existingUser);
                return app(RegistrationResponse::class, ['url' => '/alumni/applicant-form']);
            } else {
                $this->addError('School_id', 'Invalid student ID');
                return null;
            }
        } elseif (!empty($data['email'])) {
            $user = User::create([
                'name' => $data['name'] ?? null,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $role = Role::firstOrCreate(['name' => env('USER_DEFAULT_ROLE'), 'guard_name' => 'web']);
            $user->assignRole($role);
            $this->sendEmailVerificationNotification($user);
            Filament::auth()->login($user);
            return app(RegistrationResponse::class);
        }
        return null;
    }
}
