<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Contracts\Support\Renderable;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \App\Models\Client $client
     * @return Renderable
     */
    public function index(Request $request)
    {
        $request->flash();

        $query = $request->query('q', '');

        $clients = Client::where('clientNumber', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->orderBy("name", "asc")
            ->paginate(16);
        $clients->appends(['q' => $query]);

        return view('clients.clients', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create(
            [
                'clientNumber' => $request->input('clientNumber'),
                'name' => $request->input('name'),
                'contactEmail' => $request->input('contactEmail'),
                'contactPhoneNumber' => $request->input('contactPhoneNumber'),
            ]
        );

        $request->session()->flash('success', 'Cient ' . $client->name . ' was successfully created.');

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.client', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return Renderable
     */
    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->All());

        $request->session()->flash('success', 'Information of client ' . $client->id .
            ' - ' . $client->name . ' was successfully updated.');

        return redirect(route('clients.show', ['client' => $client]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Client $client)
    {
        $client->delete();

        $request->session()->flash('success', 'Client ' . $client->clientNumber . ' - ' . $client->name . ' was successfully deleted.');

        return redirect(route('clients.index'));
    }
}
