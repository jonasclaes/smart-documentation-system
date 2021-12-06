<?php

namespace App\Policies;

use App\Models\RevisionRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RevisionRequestPolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "revision-request:";

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view-any") return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RevisionRequest $revisionRequest)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "create") return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RevisionRequest $revisionRequest)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RevisionRequest $revisionRequest)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RevisionRequest $revisionRequest)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RevisionRequest $revisionRequest)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") return true;
        }
    }
}
