<?php

namespace App\Policies;

use App\Models\QRCode;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class QRCodePolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "qr-code:";

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
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to view all qr-codes.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QRCode  $qRCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, QRCode $qRCode)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} viewed QR-code for file {$qRCode->file}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to view QR-code for file {$qRCode->file}.");
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
                Log::channel('application')->info("{$user->firstName} {$user->lastName} created a new QR-code.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to create a new QR-code.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QRCode  $qRCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, QRCode $qRCode)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} updated QR-code for file {$qRCode->file}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to update QR-code for file {$qRCode->file}.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QRCode  $qRCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, QRCode $qRCode)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} deleted QR-code for file {$qRCode->file}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to delete QR-code for file {$qRCode->file}.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QRCode  $qRCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, QRCode $qRCode)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} restored QR-code for file {$qRCode->file}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to restore QR-code for file {$qRCode->file}.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QRCode  $qRCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, QRCode $qRCode)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::channel('application')->info("{$user->firstName} {$user->lastName} force-deleted QR-code for file {$qRCode->file}.");
                return true;
            }
        }
        Log::channel('application')->info("{$user->firstName} {$user->lastName} tried to force-delete QR-code for file {$qRCode->file}.");
    }
}
