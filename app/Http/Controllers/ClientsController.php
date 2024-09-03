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
        $clients = $request->user()->clients()
            ->with('bookings')
            ->withCount('bookings')
            ->get();

        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function show(Client $client)
    {
        $this->authorize('view', $client);

        $client->load([
            'bookings' => function ($query) {
                return $query->orderByDesc('id');
            }
        ]);

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
