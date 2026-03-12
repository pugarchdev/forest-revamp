<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteDetail;
use App\Models\ClientDetail;

class SiteController extends Controller
{

    public function index()
    {
        $sites = SiteDetail::where('company_id', session('company_id'))->get();

        return view('sites.index', compact('sites'));
    }

    public function create()
    {
        $clients = ClientDetail::pluck('name', 'id');

        return view('sites.create', compact('clients'));
    }

    public function store(Request $request)
    {

        $client = ClientDetail::find($request->client_id);

        SiteDetail::create([
            'name' => $request->site_name,
            'address' => $request->site_address,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'contactPerson' => $request->contact_person_name,
            'mobile' => $request->contact_person_number,
            'sosContact' => $request->sos_number,
            'email' => $request->email,
            'earlyTime' => $request->early_cutoff,
            'lateTime' => $request->late_cutoff,
            'siteType' => $request->site_type,
            'client_id' => $request->client_id,
            'client_name' => $client->name,
            'company_id' => session('company_id')
        ]);

        return redirect()->route('sites.index')
            ->with('success', 'Site created successfully');
    }
    public function show($id)
    {
        $site = SiteDetail::findOrFail($id);

        return view('sites.show', compact('site'));
    }

    public function edit($id)
    {
        $site = SiteDetail::findOrFail($id);

        $clients = ClientDetail::pluck('name', 'id');

        return view('sites.edit', compact('site', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $site = SiteDetail::findOrFail($id);

        $client = ClientDetail::find($request->client_id);

        $site->update([
            'name' => $request->site_name,
            'address' => $request->site_address,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'contactPerson' => $request->contact_person_name,
            'mobile' => $request->contact_person_number,
            'sosContact' => $request->sos_number,
            'email' => $request->email,
            'earlyTime' => $request->early_cutoff,
            'lateTime' => $request->late_cutoff,
            'siteType' => $request->site_type,
            'client_id' => $request->client_id,
            'client_name' => $client->name
        ]);

        return redirect()->route('sites.index')
            ->with('success', 'Site updated successfully');
    }

    public function destroy($id)
    {
        $site = SiteDetail::findOrFail($id);

        $site->delete();

        return redirect()->route('sites.index')
            ->with('success', 'Site deleted successfully');
    }

    public function clientSites($id)
    {
        $client = ClientDetail::findOrFail($id);

        $sites = SiteDetail::where('client_id', $id)
            ->where('company_id', session('company_id'))
            ->get();

        return view('sites.index', compact('sites', 'client'));
    }
}
