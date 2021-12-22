<?php

namespace App\Policies;

use App\Models\RevisionRequestDocument;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class RevisionRequestDocumentPolicy
{
    use HandlesAuthorization;

    const PERMISSION_PREFIX = "revision-request-document:";

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
        Log::info("{$user->firstName} {$user->lastName} tried to view all revision request documents.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RevisionRequestDocument $revisionRequestDocument)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "view") {
                Log::info("{$user->firstName} {$user->lastName} viewed the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to view the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
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
                Log::info("{$user->firstName} {$user->lastName} created a new revision request document.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to create a new revision request document.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RevisionRequestDocument $revisionRequestDocument)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "update") {
                Log::info("{$user->firstName} {$user->lastName} updated the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to update the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RevisionRequestDocument $revisionRequestDocument)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "delete") {
                Log::info("{$user->firstName} {$user->lastName} deleted the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to delete the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RevisionRequestDocument $revisionRequestDocument)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "restore") {
                Log::info("{$user->firstName} {$user->lastName} restored the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to restore the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RevisionRequestDocument $revisionRequestDocument)
    {
        foreach ($user->permissions as $permission) {
            if ($permission->permissionName === self::PERMISSION_PREFIX . "force-delete") {
                Log::info("{$user->firstName} {$user->lastName} force-deleted the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
                return true;
            }
        }
        Log::info("{$user->firstName} {$user->lastName} tried to force-delete the revision request document {$revisionRequestDocument->fileName} for revision {$revisionRequestDocument->revisionRequestId}.");
    }
}
