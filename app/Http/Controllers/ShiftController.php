<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\ShiftAssigned;
use App\Models\SiteDetail;

class ShiftController extends Controller
{

    public function index($site_id)
    {
        $site = SiteDetail::findOrFail($site_id);

        $shifts = ShiftAssigned::where('site_id', $site_id)
            ->where('company_id', session('company_id'))
            ->get();

        return view('shifts.index', compact('shifts', 'site'));
    }


    public function create($site_id)
    {
        $site = SiteDetail::findOrFail($site_id);

        return view('shifts.create', compact('site'));
    }

    public function edit($site_id, $id)
    {
        $site = SiteDetail::findOrFail($site_id);

        $shift = Shift::findOrFail($id);

        return view('shifts.edit', compact('site', 'shift'));
    }

    public function update(Request $request, $site_id, $id)
    {
        $shift = Shift::findOrFail($id);

        $shift->update([
            'shift_name' => $request->shift_name,
            'shift_start' => $request->shift_start,
            'shift_end' => $request->shift_end,
            'shift_time' => $request->shift_time
        ]);

        return redirect()->route('shifts.index', $site_id)
            ->with('success', 'Shift updated');
    }

    public function destroy($site_id, $id)
    {
        Shift::findOrFail($id)->delete();

        return redirect()->route('shifts.index', $site_id)
            ->with('success', 'Shift deleted');
    }

    public function store(Request $request, $site_id)
    {
        $site = SiteDetail::findOrFail($site_id);

        $shiftTime = $request->start_time . " - " . $request->end_time;

        $shift = Shift::create([
            'shift_name' => $request->shift_name,
            'shift_time' => $shiftTime,
            'company_id' => session('company_id')
        ]);

        ShiftAssigned::create([
            'site_id' => $site->id,
            'site_name' => $site->name,
            'shift_id' => $shift->id,
            'shift_name' => $shift->shift_name,
            'shift_time' => $shift->shift_time,
            'client_id' => $site->client_id,
            'company_id' => session('company_id')
        ]);

        return redirect()->route('shifts.index', $site_id)
            ->with('success', 'Shift created successfully');
    }
}
