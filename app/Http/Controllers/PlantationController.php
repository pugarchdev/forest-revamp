<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plantation;
use App\Models\User;
use App\Models\Grid;

class PlantationController extends Controller
{

    public function dashboard()
    {
        $plantations = Plantation::all();
        return view('plantation.dashboard', compact('plantations'));
    }

    public function grids()
    {
        $grids = Grid::all();
        return view('plantation.grids', compact('grids'));
    }

    public function users()
    {
        $users = User::all();
        return view('plantation.users', compact('users'));
    }

    public function analytics()
    {
        return view('plantation.analytics');
    }

    // SHOW WORKFLOW PAGE
    public function workflow($id)
    {
        $plantation = Plantation::findOrFail($id);

        $phases = [
            'identification',
            'measurement',
            'planning',
            'planting',
            'fencing',
            'observation'
        ];

        return view('plantation.workflow', compact('plantation','phases'));
    }


    // SAVE FORM DATA AND MOVE TO NEXT PHASE
    public function saveWorkflow(Request $request,$id)
    {
        $plantation = Plantation::findOrFail($id);

        $phases = [
            'identification',
            'measurement',
            'planning',
            'planting',
            'fencing',
            'observation'
        ];

        $currentIndex = array_search($plantation->current_phase,$phases);

        // Save phase data (example)
        $data = $request->all();

        // you can store this in another table if needed
        // example: plantation_logs table

        // Move to next phase
        if($currentIndex !== false && isset($phases[$currentIndex+1]))
        {
            $plantation->current_phase = $phases[$currentIndex+1];
            $plantation->save();
        }

        return redirect('/plantation/workflow/'.$plantation->id)
                ->with('success','Phase completed');
    }

}
