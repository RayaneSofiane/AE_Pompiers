<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\FireStation;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $fireStations = FireStation::all();
        $query = Vehicle::with(['vehicleType', 'fireStation']);
        
        if ($request->has('fire_station_id') && $request->fire_station_id != '') {
            $query->where('id_fire_station', $request->fire_station_id);
        }
        
        $vehicles = $query->get();
        return view('vehicle', ['vehicles' => $vehicles, 'fireStations' => $fireStations, 'selectedStationId' => $request->fire_station_id]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'no_identification' => 'required|string|max:50|unique:vehicles,no_identification',
            'immatriculation' => 'required|string|max:20|unique:vehicles,immatriculation',
            'annee_mise_en_service' => 'required|integer|min:1900|max:' . date('Y'),
            'marque' => 'required|string|max:100',
            'modele' => 'required|string|max:100',
            'id_type_vehicle' => 'required|exists:vehicle_types,id',
            'id_fire_station' => 'required|exists:fire_stations,id',
        ]);

        Vehicle::create($validated);
        return redirect('/vehicles')->with('success', 'Vehicle added successfully.');
    }

    public function formModify($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicleTypes = VehicleType::all();
        $fireStations = FireStation::all();
        return view('vehicleModify', compact('vehicle', 'vehicleTypes', 'fireStations'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_identification' => 'required|string|max:50|unique:vehicles,no_identification,' . $id,
            'immatriculation' => 'required|string|max:20|unique:vehicles,immatriculation,' . $id,
            'annee_mise_en_service' => 'required|integer|min:1900|max:' . date('Y'),
            'marque' => 'required|string|max:100',
            'modele' => 'required|string|max:100',
            'id_type_vehicle' => 'required|exists:vehicle_types,id',
            'id_fire_station' => 'required|exists:fire_stations,id',
        ]);

        Vehicle::find($id)->update($validated);
        return redirect('/vehicles')->with('success', 'Vehicle updated successfully.');
    }

    public function delete($id)
    {
        Vehicle::find($id)->delete();
        return redirect('/vehicles')->with('success', 'Vehicle deleted successfully.');
    }

    public function clear()
    {
        Vehicle::truncate();
        return redirect('/vehicles')->with('success', 'All vehicles cleared successfully.');
    }
}
