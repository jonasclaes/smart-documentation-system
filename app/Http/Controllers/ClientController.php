<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * Setup controller.
     */
    public function __construct()
    {
        $this->authorizeResource(Client::class);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $request->flash();

        $query = $request->query('q', '');

        $clients = Client::where('clientNumber', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->paginate(50);
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
        $latestClient = Client::all()->sortBy("clientNumber")->last();
        $clientNumber = "";
        if ($latestClient && is_numeric($latestClient->clientNumber)) {
            $clientNumber = sprintf("%04d", intval($latestClient->clientNumber) + 1);
        }

        return view('clients.create', ['clientNumber' => $clientNumber]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return RedirectResponse
     */
    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->validated());

        $request->session()->flash('success', 'Cient ' . $client->name . ' was successfully created.');

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return Renderable
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
     * @param UpdateClientRequest $request
     * @param Client $client
     * @return RedirectResponse
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        $request->session()->flash('success', 'Information of client ' . $client->id .
            ' - ' . $client->name . ' was successfully updated.');

        return redirect(route('clients.show', ['client' => $client]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return RedirectResponse
     */
    public function destroy(Request $request, Client $client)
    {
        $client->delete();

        $request->session()->flash('success', 'Client ' . $client->clientNumber . ' - ' . $client->name . ' was successfully deleted.');

        return redirect(route('clients.index'));
    }
}
