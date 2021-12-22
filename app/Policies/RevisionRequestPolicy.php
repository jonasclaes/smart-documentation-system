<?php

namespace App\Policies;

use App\Models\RevisionRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

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
        Log::info("{$user->firstName} {$user->lastName} tried to view all revision requests.");
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
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::info("{$user->firstName} {$user->lastName} viewed revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to view revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
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
                Log::info("{$user->firstName} {$user->lastName} created a new revision request.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to create a new revision request.");
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
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::info("{$user->firstName} {$user->lastName} updated revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} updated revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
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
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::info("{$user->firstName} {$user->lastName} deleted revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to delete revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
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
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::info("{$user->firstName} {$user->lastName} restored revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to restore revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
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
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::info("{$user->firstName} {$user->lastName} restored revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to restore revision request {$revisionRequest->name} for file ID {$revisionRequest->fileId}.");
    }
}
