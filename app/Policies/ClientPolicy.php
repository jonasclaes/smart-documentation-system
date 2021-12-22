<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ClientPolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "client:";

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
        Log::info("{$user->firstName} {$user->lastName} tried to view all clients.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return bool
     */
    public function view(User $user, Client $client)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::info("{$user->firstName} {$user->lastName} viewed client {$client->name} (Client Number: {$client->clientNumber}).");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to view client {$client->name} (Client Number: {$client->clientNumber}).");
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
                Log::info("{$user->firstName} {$user->lastName} created a new client.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to create e new client.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return bool
     */
    public function update(User $user, Client $client)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::info("{$user->firstName} {$user->lastName} updated client {$client->name} (Client Number: {$client->clientNumber}).");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to update client {$client->name} (Client Number: {$client->clientNumber}).");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return bool
     */
    public function delete(User $user, Client $client)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::info("{$user->firstName} {$user->lastName} deleted client {$client->name} (Client Number: {$client->clientNumber}).");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to delete client {$client->name} (Client Number: {$client->clientNumber}).");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return bool
     */
    public function restore(User $user, Client $client)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::info("{$user->firstName} {$user->lastName} restored client {$client->name} (Client Number: {$client->clientNumber}).");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to restore client {$client->name} (Client Number: {$client->clientNumber}).");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return bool
     */
    public function forceDelete(User $user, Client $client)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::info("{$user->firstName} {$user->lastName} force-deleted client {$client->name} (Client Number: {$client->clientNumber}).");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to force-delete client {$client->name} (Client Number: {$client->clientNumber}).");
    }
}
