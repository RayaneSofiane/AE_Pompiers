<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicleTypes = VehicleType::all();
        return view('vehicleType', ['vehicleTypes' => $vehicleTypes]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:vehicle_types,code',
            'description' => 'required|string|max:200',
        ]);

        VehicleType::create($validated);
        return redirect('/vehicle-types')->with('success', 'Type de véhicule ajouté avec succès.');
    }

    public function formModify($id)
    {
        $vehicleType = VehicleType::find($id);
        return view('vehicleTypeModify', ['vehicleType' => $vehicleType]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:vehicle_types,code,' . $id,
            'description' => 'required|string|max:200',
        ]);

        VehicleType::find($id)->update($validated);
        return redirect('/vehicle-types')->with('success', 'Type de véhicule mis à jour avec succès.');
    }

    public function delete($id)
    {
        VehicleType::find($id)->delete();
        return redirect('/vehicle-types')->with('success', 'Type de véhicule supprimé avec succès.');
    }

    public function clear()
    {
        VehicleType::truncate();
        return redirect('/vehicle-types')->with('success', 'Tous les types de véhicules ont été supprimés avec succès.');
    }
}
