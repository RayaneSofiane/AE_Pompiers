<?php

namespace App\Http\Controllers;

use App\Models\InterventionRecord;
use App\Models\InterventionType;
use App\Models\FireStation;
use App\Models\Firefighter;
use Illuminate\Http\Request;

class InterventionRecordController extends Controller
{
    public function index($fireStationId = null)
    {
        $fireStations = FireStation::all();
        
        if ($fireStationId) {
            $interventionRecords = InterventionRecord::where('id_fire_station', $fireStationId)
                ->with(['interventionType', 'fireStation'])
                ->get();
            $selectedFireStation = FireStation::findOrFail($fireStationId);
        } else {
            $interventionRecords = InterventionRecord::with(['interventionType', 'fireStation'])->get();
            $selectedFireStation = null;
        }

        return view('interventionRecord', compact('interventionRecords', 'fireStations', 'selectedFireStation'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'date_time_start' => 'required|date_format:Y-m-d\TH:i',
            'address' => 'required|string|max:255',
            'summary' => 'required|string',
            'id_type_intervention' => 'required|exists:intervention_types,id',
            'id_fire_station' => 'required|exists:fire_stations,id',
            'id_captain' => 'nullable|exists:firefighters,id',
        ]);

        InterventionRecord::create($validated);

        return redirect('/intervention-records')->with('success', 'Intervention record added successfully!');
    }

    public function open($id)
    {
        $interventionRecord = InterventionRecord::with(['interventionType', 'fireStation'])->findOrFail($id);
        return view('interventionRecordView', compact('interventionRecord'));
    }

    public function formModify($id)
    {
        $interventionRecord = InterventionRecord::findOrFail($id);
        $interventionTypes = InterventionType::all();
        $captains = Firefighter::all();
        return view('interventionRecordModify', compact('interventionRecord', 'interventionTypes', 'fireStations', 'captai
        return view('interventionRecordModify', compact('interventionRecord', 'interventionTypes', 'fireStations'));
    }

    public function update(Request $request, $id)
    {
        $interventionRecord = InterventionRecord::findOrFail($id);

        $validated = $request->validate([
            'date_time_start' => 'required|date_format:Y-m-d\TH:i',
            'address' => 'required|string|max:255',
            'summary' => 'required|string',
            'id_type_intervention' => 'required|exists:intervention_types,id',
            'id_captain' => 'nullable|exists:firefighters,id',
            'id_fire_station' => 'required|exists:fire_stations,id',
        ]);

        $interventionRecord->update($validated);

        return redirect('/intervention-records')->with('success', 'Intervention record updated successfully!');
    }

    public function delete($id)
    {
        $interventionRecord = InterventionRecord::findOrFail($id);
        $interventionRecord->delete();

        return redirect('/intervention-records')->with('success', 'Intervention record deleted successfully!');
    }

    public function clear()
    {
        InterventionRecord::truncate();

        return redirect('/intervention-records')->with('success', 'All intervention records cleared!');
    }
}
