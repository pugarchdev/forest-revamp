<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientDetail;

class ClientController extends Controller
{

    // Show all clients
    public function index()
    {
        $clients = ClientDetail::where('company_id', session('company_id'))
                    ->paginate(10);

        return view('clients.index', compact('clients'));
    }


    // Show create form
    public function create()
    {
        return view('clients.create');
    }


    // Store new client
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required',
            'email' => 'required|email',
            'spokesperson' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
        ]);

        ClientDetail::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'spokesperson' => $request->spokesperson,
            'address' => $request->address,
            'company_id' => session('company_id'),
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'relationManager' => $request->relationManager,
            'relationManagerContact' => $request->relationManagerContact,
            'isActive' => 1
        ]);

        return redirect()->route('clients.index')
            ->with('success','Client created successfully');
    }


    // Show single client
    public function show($id)
    {
        $client = ClientDetail::findOrFail($id);

        return view('clients.show', compact('client'));
    }


    // Show edit form
    public function edit($id)
    {
        $client = ClientDetail::findOrFail($id);

        return view('clients.edit', compact('client'));
    }


    // Update client
    public function update(Request $request, $id)
    {
        $client = ClientDetail::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
        ]);

        $client->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'spokesperson' => $request->spokesperson,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'relationManager' => $request->relationManager,
            'relationManagerContact' => $request->relationManagerContact
        ]);

        return redirect()->route('clients.index')
            ->with('success','Client updated successfully');
    }


    // Delete client
    public function destroy($id)
    {
        $client = ClientDetail::findOrFail($id);

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success','Client deleted successfully');
    }
}
