<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        $clients = $request->user()->clients;

        foreach ($clients as $client) {
            $client->append('bookings_count');
        }

        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function show(Client $client)
    {
        $this->authorize('view', $client);

        $client->load('bookings');

        return view('clients.show', [
            'client' => ClientResource::make($client)
        ]);
    }

    public function store(ClientStoreRequest $request)
    {
        $validated = $request->validated();

        return $request->user()->clients()->create($validated);
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return response()->json(['message' => 'Client deleted']);
    }
}
