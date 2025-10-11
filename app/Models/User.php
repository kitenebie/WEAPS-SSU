<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, TwoFactorAuthenticatable;

    /**
     * Spatie Permission guard name for this model.
     * Ensures roles/permissions use the correct guard for multi-panel Filament.
     */
    protected string $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Assign a default role to newly created users.
     * Uses Filament Shield's configured panel user role name, or 'panel_user' by default.
     */
    protected static function booted(): void
    {
        static::created(function (self $user): void {
            $roleName = config('filament-shield.panel_user.name', 'panel_user');

            // Ensure the role exists for the correct guard
            Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => $user->getDefaultGuardName()]
            );

            // Assign default role if user has none
            if (! $user->hasAnyRole()) {
                $user->assignRole($roleName);
            }
        });
    }

    
    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the companies for the user.
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Get the curriculum vitae for the user.
     */
    public function curriculumVitae()
    {
        return $this->hasOne(CurriculumVitae::class);
    }
}
