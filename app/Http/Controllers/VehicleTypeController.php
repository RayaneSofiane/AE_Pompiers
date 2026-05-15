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
        return redirect('/vehicle-types')->with('success', 'Vehicle type added successfully.');
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
        return redirect('/vehicle-types')->with('success', 'Vehicle type updated successfully.');
    }

    public function delete($id)
    {
        VehicleType::find($id)->delete();
        return redirect('/vehicle-types')->with('success', 'Vehicle type deleted successfully.');
    }

    public function clear()
    {
        VehicleType::truncate();
        return redirect('/vehicle-types')->with('success', 'All vehicle types cleared successfully.');
    }
}
