<?php

namespace App\Policies;

use App\Models\ClientContact;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ClientContactPolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "client-contact:";

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
        Log::info("{$user->firstName} {$user->lastName} tried to view all client contacts.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClientContact  $clientContact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ClientContact $clientContact)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::info("{$user->firstName} {$user->lastName} viewed client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to view client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
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
                Log::info("{$user->firstName} {$user->lastName} created a new client contact.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to create a new client contact.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClientContact  $clientContact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ClientContact $clientContact)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::info("{$user->firstName} {$user->lastName} updated client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to update client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClientContact  $clientContact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ClientContact $clientContact)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::info("{$user->firstName} {$user->lastName} deleted client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to delete client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClientContact  $clientContact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ClientContact $clientContact)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::info("{$user->firstName} {$user->lastName} restored client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to restore client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClientContact  $clientContact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ClientContact $clientContact)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::info("{$user->firstName} {$user->lastName} force-deleted client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to force-delete client contact {$clientContact->firstName} {$clientContact->lastName} for client ID {$clientContact->clientId}.");
    }
}
