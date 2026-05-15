<?php

namespace App\Http\Controllers;

use App\Models\FireStation;
use App\Models\State;
use Illuminate\Http\Request;

class FireStationController extends Controller
{
    public function index()
    {
        $fireStations = FireStation::with('state')->get();
        return view('fireStation', compact('fireStations'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:12',
            'id_state' => 'required|exists:states,id',
        ]);

        FireStation::create($validated);

        return redirect('/fireStations')->with('success', 'Fire station added successfully!');
    }

    public function formModifyFireStation($id)
    {
        $fireStation = FireStation::findOrFail($id);
        $states = State::all();
        return view('fireStationModify', compact('fireStation', 'states'));
    }

    public function update(Request $request, $id)
    {
        $fireStation = FireStation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:12',
            'id_state' => 'required|exists:states,id',
        ]);

        $fireStation->update($validated);

        return redirect('/fireStations')->with('success', 'Fire station updated successfully!');
    }

    public function delete($id)
    {
        $fireStation = FireStation::findOrFail($id);
        $fireStation->delete();

        return redirect('/fireStations')->with('success', 'Fire station deleted successfully!');
    }

    public function clear()
    {
        FireStation::truncate();

        return redirect('/fireStations')->with('success', 'All fire stations cleared!');
    }
}
