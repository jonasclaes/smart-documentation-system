<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientContactRequest;
use App\Http\Requests\UpdateClientContactRequest;
use App\Models\Client;
use App\Models\ClientContact;
use App\Models\File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Client $client
     * @return Renderable
     */
    public function create(Client $client)
    {
        return view('clientContacts.create', ['client' => $client, 'clients' => Client::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Client $client
     * @param  StoreClientContactRequest  $request
     * @return RedirectResponse
     */
    public function store(Client $client, StoreClientContactRequest $request)
    {
        $clientContact = ClientContact::create($request->validated());

        return redirect()->route('clients.show', ['client' => $clientContact->client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @param  \App\Models\ClientContact  $clientContact
     * @return Renderable
     */
    public function edit(Client $client, ClientContact $clientContact)
    {
        return view('clientContacts.edit', ['client' => $client, 'clientContact' => $clientContact, 'clients' => Client::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Client $client
     * @param  UpdateClientContactRequest  $request
     * @param  \App\Models\ClientContact  $clientContact
     * @return RedirectResponse
     */
    public function update(UpdateClientContactRequest $request, Client $client, ClientContact $clientContact)
    {
        $clientContact->update($request->all());

        return redirect(route('clients.show', ['client' => $clientContact->client]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @param  \App\Models\ClientContact  $clientContact
     * @return RedirectResponse
     */
    public function destroy(Client $client, ClientContact $clientContact)
    {
        $clientContact->delete();

        return redirect()->back();
    }
}
