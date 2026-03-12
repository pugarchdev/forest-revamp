<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shift;
use App\Models\SiteAssign;
use App\Models\SiteDetail;

class SiteEmployeeController extends Controller
{

    public function index($site_id)
    {
        $site = SiteDetail::findOrFail($site_id);

        $employees = SiteAssign::where('site_id', $site_id)
            ->where('company_id', session('company_id'))
            ->get();

        return view('site_employees.index', compact('employees', 'site'));
    }

    public function create($site_id)
    {
        $site = SiteDetail::findOrFail($site_id);

        $shifts = Shift::where('company_id', session('company_id'))->get();

        $employees = User::where('company_id', session('company_id'))
            ->get();

        return view('site_employees.create', compact('site', 'shifts', 'employees'));
    }
    public function show($site_id, $id)
    {
        $assignment = SiteAssign::with([
            'user',
            'site',
            'shift',
            'client',
            'supervisor'
        ])->findOrFail($id);

        return view('site_employees.show', compact('assignment'));
    }
    public function edit($site_id, $id)
    {
        $site = SiteDetail::findOrFail($site_id);

        $assignment = SiteAssign::findOrFail($id);

        $employees = User::where('company_id', session('company_id'))->get();

        $shifts = Shift::where('company_id', session('company_id'))->get();

        return view('site_employees.edit', compact(
            'assignment',
            'employees',
            'shifts',
            'site'
        ));
    }


    public function update(Request $request, $site_id, $id)
    {
        $assignment = SiteAssign::findOrFail($id);

        $user = User::findOrFail($request->user_id);

        $shift = Shift::findOrFail($request->shift_id);

        $weekoff = implode(',', $request->weekoff ?? []);

        $assignment->update([

            'user_id' => $user->id,
            'user_name' => $user->name,

            'shift_id' => $shift->id,
            'shift_name' => $shift->shift_name,
            'shift_time' => $shift->shift_time,

            'startDate' => $request->start_date,
            'endDate' => $request->end_date,

            'weekoff' => $weekoff

        ]);

        return redirect()
            ->route('site.employees', $site_id)
            ->with('success', 'Employee updated successfully');
    }
    public function destroy($site_id, $id)
    {
        $employee = SiteAssign::findOrFail($id);

        $employee->delete();

        return redirect()
            ->route('site.employees', $site_id)
            ->with('success', 'Employee removed successfully');
    }

    public function store(Request $request, $site_id)
    {

        $user = User::findOrFail($request->user_id);

        $shift = Shift::findOrFail($request->shift_id);

        // Prevent duplicate assignment
        $exists = SiteAssign::where('site_id', $site_id)
            ->where('user_id', $request->user_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Employee already assigned');
        }

        $weekoff = implode(',', $request->weekoff ?? []);

        SiteAssign::create([

            'company_id' => session('company_id'),

            'user_id' => $user->id,
            'user_name' => $user->name,

            'site_id' => $site_id,
            'site_name' => $request->site_name,

            'shift_id' => $shift->id,
            'shift_name' => $shift->shift_name,
            'shift_time' => $shift->shift_time,

            'startDate' => $request->start_date,
            'endDate' => $request->end_date,

            'weekoff' => $weekoff,

            'role_id' => $user->role_id
        ]);

        return redirect()->route('site.employees', $site_id)
            ->with('success', 'Employee assigned successfully');
    }
}
