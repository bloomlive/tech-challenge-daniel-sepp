<?php

namespace App\Http\Controllers;

use App\Client;
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

    public function store(Request $request)
    {
        $client = new Client;
        $client->name = $request->get('name');
        $client->email = $request->get('email');
        $client->phone = $request->get('phone');
        $client->adress = $request->get('adress');
        $client->city = $request->get('city');
        $client->postcode = $request->get('postcode');
        $client->save();

        return $client;
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return redirect()->back()->with('message', 'Client deleted.');
    }
}
