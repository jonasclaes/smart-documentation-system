<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class UserPolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "user:";

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
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to view all users.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} viewed information of user: {$model->firstName} {$model->lastName}.");
                return true;
            }
        }
        Log::channel('application')->error($user->firstName . ' ' . $user->lastName . "failed to view information of user: " . $model->firstName . ' ' . $model->lastName . '.');
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
                Log::channel('application')->info("{$user->firstName} {$user->lastName} created a new user.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to create a new user.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} updated the information of user: {$model->firstName} {$model->lastName}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to update the information of user: {$model->firstName} {$model->lastName}.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} deleted user: {$model->firstName} {$model->lastName}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to delete user: {$model->firstName} {$model->lastName}.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} restored user: {$model->firstName} {$model->lastName}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to restore user: {$model->firstName} {$model->lastName}.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} force-deleted user: {$model->firstName} {$model->lastName}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to force-delete user: {$model->firstName} {$model->lastName}.");
    }
}
