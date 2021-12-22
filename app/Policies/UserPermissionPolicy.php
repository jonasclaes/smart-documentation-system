<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class UserPermissionPolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "user-permission:";

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view-any") return true;
        }
        Log::info("{$user->firstName} {$user->lastName} tried to access all user permissions.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPermission  $userPermission
     * @return bool
     */
    public function view(User $user, UserPermission $userPermission)
    {
        if ($user->id === $userPermission->userId) return true;

        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::info("{$user->firstName} {$user->lastName} viewed the user permissions of user ID {$userPermission->userId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to view the user permissions of user ID {$userPermission->userId}.");

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "create") {
                Log::info("{$user->firstName} {$user->lastName} created new user permissions.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to create new user permissions.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPermission  $userPermission
     * @return bool
     */
    public function update(User $user, UserPermission $userPermission)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::info("{$user->firstName} {$user->lastName} updated user permission {$userPermission->permissionName} of user ID {$userPermission->userId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to update user permission {$userPermission->permissionName} of user ID {$userPermission->userId}.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPermission  $userPermission
     * @return bool
     */
    public function delete(User $user, UserPermission $userPermission)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::info("{$user->firstName} {$user->lastName} deleted user permission {$userPermission->permissionName} of user ID {$userPermission->userId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to delete user permission {$userPermission->permissionName} of user ID {$userPermission->userId}.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPermission  $userPermission
     * @return bool
     */
    public function restore(User $user, UserPermission $userPermission)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::info("{$user->firstName} {$user->lastName} restored user permission {$userPermission->permissionName} of user ID {$userPermission->userId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to restore user permission {$userPermission->permissionName} of user ID {$userPermission->userId}.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPermission  $userPermission
     * @return bool
     */
    public function forceDelete(User $user, UserPermission $userPermission)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::info("{$user->firstName} {$user->lastName} force-deleted user permission {$userPermission->permissionName} of user ID {$userPermission->userId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to force-delete user permission {$userPermission->permissionName} of user ID {$userPermission->userId}.");
    }
}
