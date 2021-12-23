<?php

namespace App\Policies;

use App\Models\RevisionRequestCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class RevisionRequestCategoryPolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "revision-request-category:";

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
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to view all revision request categories.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestCategory  $revisionRequestCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RevisionRequestCategory $revisionRequestCategory)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} viewed revision request category: {$revisionRequestCategory->name}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to view revision request category: {$revisionRequestCategory->name}.");
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
            if ($permission->permissionName === self::PERMISSION_PREFIX . "create") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} created a new revision request category.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to create a new revision request category.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestCategory  $revisionRequestCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RevisionRequestCategory $revisionRequestCategory)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} updated revision request category: {$revisionRequestCategory->name}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to update revision request category: {$revisionRequestCategory->name}.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestCategory  $revisionRequestCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RevisionRequestCategory $revisionRequestCategory)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} deleted revision request category: {$revisionRequestCategory->name}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to delete revision request category: {$revisionRequestCategory->name}.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestCategory  $revisionRequestCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RevisionRequestCategory $revisionRequestCategory)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::info("{$user->firstName} {$user->lastName} restored revision request category: {$revisionRequestCategory->name}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to restore revision request category: {$revisionRequestCategory->name}.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestCategory  $revisionRequestCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RevisionRequestCategory $revisionRequestCategory)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::info("{$user->firstName} {$user->lastName} force-deleted revision request category: {$revisionRequestCategory->name}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to force-delete revision request category: {$revisionRequestCategory->name}.");
    }
}
