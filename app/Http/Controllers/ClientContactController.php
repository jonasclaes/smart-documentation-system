<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientContactRequest;
use App\Http\Requests\UpdateClientContactRequest;
use App\Models\Client;
use App\Models\ClientContact;
use App\Models\File;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws AuthorizationException
     */
    public function create(Client $client)
    {
        $this->authorize('create', ClientContact::class);

        return view('clientContacts.create', ['client' => $client, 'clients' => Client::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Client $client
     * @param StoreClientContactRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Client $client, StoreClientContactRequest $request)
    {
        $this->authorize('create', ClientContact::class);

        $clientContact = ClientContact::create($request->validated());

        return redirect()->route('clients.show', ['client' => $clientContact->client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @param \App\Models\ClientContact $clientContact
     * @return Renderable
     * @throws AuthorizationException
     */
    public function edit(Client $client, ClientContact $clientContact)
    {
        $this->authorize('update', $clientContact);

        return view('clientContacts.edit', ['client' => $client, 'clientContact' => $clientContact, 'clients' => Client::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Client $client
     * @param UpdateClientContactRequest $request
     * @param \App\Models\ClientContact $clientContact
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateClientContactRequest $request, Client $client, ClientContact $clientContact)
    {
        $this->authorize('update', $clientContact);

        $clientContact->update($request->all());

        return redirect(route('clients.show', ['client' => $clientContact->client]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @param \App\Models\ClientContact $clientContact
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Client $client, ClientContact $clientContact)
    {
        $this->authorize('delete', $clientContact);

        $clientContact->delete();

        return redirect()->back();
    }
}
