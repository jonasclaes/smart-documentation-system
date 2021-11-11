<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $request->flash();

        $lastName = $request->query('lastName', '');
        $firstName = $request->query('firstName', '');
        $username = $request->query('username', '');

        $users = User::where('firstName', 'LIKE', "%$firstName%")
            ->where('lastName', 'LIKE', "%$lastName%")
            ->where('username', 'LIKE', "%$username%")
            ->orderBy("lastName", "asc")
            ->paginate(8);

        return view('users.users', ['users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->All());
        $request->session()->flash('success', 'User ' . $user->firstName . ' ' . $user->lastName . ' was successfully created.');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.user', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Renderable
     */
    public function edit(User $user)
    {
        return view('users.edit',
            [
                'user' => $user
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->All());
        $request->session()->flash('success', 'Information of user ' . $user->firstName .
            ' ' . $user->lastName . ' was successfully updated.');
        return redirect(route('users.show', ['user' => $user]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $request->session()->flash('success', 'User ' . $user->firstName . ' ' . $user->lastName . ' was successfully deleted.');
        return redirect(route('users.index'));
    }
}
