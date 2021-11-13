<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $query = $request->query('lastName', '');

        $users = User::where('firstName', 'LIKE', "%$query%")
            ->orWhere('lastName', 'LIKE', "%$query%")
            ->orwhere('username', 'LIKE', "%$query%")
            ->orderBy("lastName", "asc")
            ->paginate(16);

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
        $user = User::create(
            [
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]
        );
        $request->session()->flash('success', 'User ' . $user->firstName . ' ' . $user->lastName . ' was successfully created.');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
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

    /**
     * Update the password voor the current user
     *
     * @param User $user
     * @return Renderable
     */
    public function resetPassword(User $user)
    {
        return view('users.password',
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
    public function updatePassword(Request $request, User $user)
    {
        $user->update(['password' => Hash::make($request->password)]);
        $request->session()->flash('success', 'Information of user ' . $user->firstName .
            ' ' . $user->lastName . ' was successfully updated.');
        return redirect(route('users.show', ['user' => $user]));
    }

    /**
     * Update  the status of a user
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @param Integer $active
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, User $user, $active)
    {
        $user->update([
            'active' => $active
        ]);

        if ($user->update()) {
            if($active == 1) {
                $request->session()->flash('success', 'User ' . $user->firstName .
                    ' ' . $user->lastName . ' is now ACTIVE.');
            } else {
                $request->session()->flash('success', 'User ' . $user->firstName .
                    ' ' . $user->lastName . ' is now DEACTIVATED.');
            }
            return redirect(route('users.show', ['user' => $user]));
        }

        return redirect(route('users.show', ['user' => $user]))->with('error', 'failed to update the
            status of user' . $user->firstName . ' ' . $user->lastName);
    }
}
