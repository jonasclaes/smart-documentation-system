<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class FilePolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "file:";

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
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to view all files.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, File $file)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} view file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to view file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
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
                Log::channel('application')->info("{$user->firstName} {$user->lastName} created a new file.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to create a new file.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, File $file)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} updated file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to update file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, File $file)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} deleted file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to delete file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, File $file)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::info("{$user->firstName} {$user->lastName} restored file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to restore file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, File $file)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::info("{$user->firstName} {$user->lastName} force-deleted file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to force-delete file {$file->name} (ID: {$file->fileId}) for client {$file->client->name}.");
    }
}
