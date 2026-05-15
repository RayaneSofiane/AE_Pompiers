<?php

namespace App\Http\Controllers;

use App\Models\Firefighter;
use App\Models\Grade;
use App\Models\FireStation;
use Illuminate\Http\Request;

class FirefighterController extends Controller
{
    public function index()
    {
        $firefighters = Firefighter::with(['grade', 'fireStation'])->get();
        return view('firefighter', ['firefighters' => $firefighters]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'matricule' => 'required|string|max:20|unique:firefighters,matricule',
            'id_grade' => 'required|exists:grades,id',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'id_fire_station' => 'required|exists:fire_stations,id',
        ]);

        Firefighter::create($validated);
        return redirect('/firefighters')->with('success', 'Firefighter added successfully.');
    }

    public function formModify($id)
    {
        $firefighter = Firefighter::find($id);
        $grades = Grade::all();
        $fireStations = FireStation::all();
        return view('firefighterModify', [
            'firefighter' => $firefighter,
            'grades' => $grades,
            'fireStations' => $fireStations,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'matricule' => 'required|string|max:20|unique:firefighters,matricule,' . $id,
            'id_grade' => 'required|exists:grades,id',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'id_fire_station' => 'required|exists:fire_stations,id',
        ]);

        Firefighter::find($id)->update($validated);
        return redirect('/firefighters')->with('success', 'Firefighter updated successfully.');
    }

    public function delete($id)
    {
        Firefighter::find($id)->delete();
        return redirect('/firefighters')->with('success', 'Firefighter deleted successfully.');
    }

    public function clear()
    {
        Firefighter::truncate();
        return redirect('/firefighters')->with('success', 'All firefighters cleared successfully.');
    }
}
