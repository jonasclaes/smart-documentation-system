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
    public function index()
    {
        $users = User::all();

        return view('users.index', ['users' => User::paginate(8)]);

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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('users.edit',
            [
                'user' => User::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->All());
        $request->session()->flash('success', 'Information of user ' . $user->firstName .
            ' ' . $user->lastName . ' was successfully updated.');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = User::findOrFail($id);
        User::destroy($id);
        $request->session()->flash('success', 'User ' . $user->firstName . ' ' . $user->lastName . ' was successfully deleted.');
        return redirect(route('users.index'));
    }
}
