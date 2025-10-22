<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use App\Models\CurriculumVitae;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurriculumVitaePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        // Check if user has the applicant role
        if ($authUser->hasRole(env('USER_APPLICANT_ROLE'))) {
            // Check if the user has a curriculum vitae and it belongs to them
            $userCv = CurriculumVitae::where('user_id', Auth::id())->first();
            return $userCv !== null;
        }

        return $authUser->can('ViewAny:CurriculumVitae');
    }

    public function view(AuthUser $authUser, CurriculumVitae $curriculumVitae): bool
    {
        // Check if user has the applicant role and the CV belongs to them
        if ($authUser->hasRole(env('USER_APPLICANT_ROLE'))) {
            return $curriculumVitae->user_id === Auth::id() ? true : false;
        }

        return $authUser->can('View:CurriculumVitae');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CurriculumVitae');
    }

    public function update(AuthUser $authUser, CurriculumVitae $curriculumVitae): bool
    {
        // Check if user has the applicant role and the CV belongs to them
        if ($authUser->hasRole(env('USER_APPLICANT_ROLE'))) {
            return $curriculumVitae->user_id === Auth::id();
        }

        return $authUser->can('Update:CurriculumVitae');
    }

    public function delete(AuthUser $authUser, CurriculumVitae $curriculumVitae): bool
    {
        // Check if user has the applicant role and the CV belongs to them
        if ($authUser->hasRole(env('USER_APPLICANT_ROLE'))) {
            return $curriculumVitae->user_id === Auth::id();
        }

        return $authUser->can('Delete:CurriculumVitae');
    }

    public function restore(AuthUser $authUser, CurriculumVitae $curriculumVitae): bool
    {
        return $authUser->can('Restore:CurriculumVitae');
    }

    public function forceDelete(AuthUser $authUser, CurriculumVitae $curriculumVitae): bool
    {
        return $authUser->can('ForceDelete:CurriculumVitae');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CurriculumVitae');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CurriculumVitae');
    }

    public function replicate(AuthUser $authUser, CurriculumVitae $curriculumVitae): bool
    {
        return $authUser->can('Replicate:CurriculumVitae');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CurriculumVitae');
    }

}