<?php

namespace App\Policies;

use App\Models\RevisionRequestComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class RevisionRequestCommentPolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "revision-request-comment:";

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
        Log::info("{$user->firstName} {$user->lastName} tried to view all revision request comments.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RevisionRequestComment $revisionRequestComment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::info("{$user->firstName} {$user->lastName} viewed comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to view comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
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
                Log::info("{$user->firstName} {$user->lastName} created a new revision request comment.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to create a new revision request comment.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RevisionRequestComment $revisionRequestComment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::info("{$user->firstName} {$user->lastName} updated comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to update comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RevisionRequestComment $revisionRequestComment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::info("{$user->firstName} {$user->lastName} deleted comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to delete comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RevisionRequestComment $revisionRequestComment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::info("{$user->firstName} {$user->lastName} restored comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to restore comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RevisionRequestComment $revisionRequestComment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::info("{$user->firstName} {$user->lastName} force-deleted comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to force-delete comment ID {$revisionRequestComment->id} for revision request {$revisionRequestComment->revisionRequestId}.");
    }
}
