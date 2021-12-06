<?php

namespace App\Http\Controllers;

use App\Models\UserPermission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function edit(UserPermission $userPermission)
    {
        $this->authorize('update', $userPermission);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserPermission $userPermission
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function update(Request $request, UserPermission $userPermission)
    {
        $this->authorize('update', $userPermission);

        $userPermission->update($request->all());
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
