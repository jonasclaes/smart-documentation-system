<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class CommentPolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "comment:";

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
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to view all comments.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Comment $comment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} viewed comment ID {$comment->id}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to view comment ID {$comment->id}.");
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
                Log::channel('application')->info("{$user->firstName} {$user->lastName} created a new comment.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to create a new comment.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Comment $comment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} updated comment ID {$comment->id}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to update comment ID {$comment->id}.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Comment $comment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} deleted comment ID {$comment->id}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to delete comment ID {$comment->id}.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Comment $comment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} restored comment ID {$comment->id}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to restore comment ID {$comment->id}.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Comment $comment)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} force-deleted comment ID {$comment->id}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to force-delete comment ID {$comment->id}.");
    }
}
