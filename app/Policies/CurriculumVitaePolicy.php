<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CurriculumVitae;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurriculumVitaePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CurriculumVitae');
    }

    public function view(AuthUser $authUser, CurriculumVitae $curriculumVitae): bool
    {
        return $authUser->can('View:CurriculumVitae');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CurriculumVitae');
    }

    public function update(AuthUser $authUser, CurriculumVitae $curriculumVitae): bool
    {
        return $authUser->can('Update:CurriculumVitae');
    }

    public function delete(AuthUser $authUser, CurriculumVitae $curriculumVitae): bool
    {
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