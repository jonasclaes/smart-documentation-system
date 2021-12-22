<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPermissionController extends Controller
{
    /**
     * Setup controller.
     */
    public function __construct()
    {
//        $this->authorizeResource(UserPermission::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', UserPermission::class);

        return $request->user()->permissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', UserPermission::class);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', UserPermission::class);

        UserPermission::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\UserPermission $userPermission
     * @return UserPermission
     * @throws AuthorizationException
     */
    public function show(UserPermission $userPermission)
    {
        $this->authorize('view', $userPermission);

        return $userPermission;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\UserPermission $userPermission
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function edit(UserPermission $userPermission, User $user)
    {
        $this->authorize('update', $userPermission);

        $permissionDescriptions = [
            "view-any" => "View all",
            "view" => "View a single",
            "create" => "Create a",
            "update" => "Update a",
            "delete" => "Delete a"
        ];

        $permissionPrefixes = [
            "client-contact",
            "client",
            "comment",
            "document",
            "file",
            "qr-code",
            "revision",
            "revision-request-category",
            "revision-request-comment",
            "revision-request-document",
            "revision-request",
            "user-permission",
            "user",
        ];

        return view('userPermissions.edit', [
            'user' => $user,
            'prefixes' => $permissionPrefixes,
            'permissions' => $permissionDescriptions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserPermission $userPermission
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function update(Request $request, UserPermission $userPermission, User $user)
    {
        $existingData = DB::table('user_permissions')->where('userId', '=', $user->id)->pluck('permissionName')->toArray();
        $permissionNames = ["view-any", "view", "create", "update", "delete", "restore", "force-delete"];
        $permissionPrefixes = [
            "client-contact",
            "client",
            "comment",
            "document",
            "file",
            "qr-code",
            "revision",
            "revision-request-category",
            "revision-request-comment",
            "revision-request-document",
            "revision-request",
            "user-permission",
            "user",
        ];

        foreach ($permissionPrefixes as $permissionPrefix) {
            foreach ($permissionNames as $permissionName) {
                $permission = "{$permissionPrefix}:{$permissionName}";
                if (isset($_POST[$permission]) && ! in_array($permission, $existingData)) {
                    $user->permissions()->create([
                        "permissionName" => "{$permissionPrefix}:{$permissionName}"]);
                }
                else if (! isset($_POST[$permission]) && in_array($permission, $existingData)) {
                    $user->permissions()->where('permissionName', $permission)->delete();
                }
            }

            $this->authorize('update', $userPermission);

            $userPermission->update($request->all());
        }
        $request->session()->flash('success', 'The user rights of ' . $user->firstName . ' ' . $user->lastName . ' were successfully updated.');

        return view('users.user', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\UserPermission $userPermission
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(UserPermission $userPermission)
    {
        $this->authorize('delete', $userPermission);
        $userPermission->delete();
    }
}
