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

        return view('clients.clients', ['clients' => $clients]);
    }
}
