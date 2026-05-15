<?php

namespace App\Http\Controllers;

use App\Models\InterventionType;
use Illuminate\Http\Request;

class InterventionTypeController extends Controller
{
    public function index()
    {
        $interventionTypes = InterventionType::all();
        return view('interventionType', compact('interventionTypes'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'no_intervention' => 'required|string|max:50|unique:intervention_types',
            'description' => 'required|string|max:200',
        ]);

        InterventionType::create($validated);

        return redirect('/intervention-types')->with('success', 'Type d\'intervention ajouté avec succès !');
    }

    public function formModify($id)
    {
        $interventionType = InterventionType::findOrFail($id);
        return view('interventionTypeModify', compact('interventionType'));
    }

    public function update(Request $request, $id)
    {
        $interventionType = InterventionType::findOrFail($id);

        $validated = $request->validate([
            'no_intervention' => 'required|string|max:50|unique:intervention_types,no_intervention,' . $id,
            'description' => 'required|string|max:200',
        ]);

        $interventionType->update($validated);

        return redirect('/intervention-types')->with('success', 'Type d\'intervention mis à jour avec succès !');
    }

    public function delete($id)
    {
        $interventionType = InterventionType::findOrFail($id);
        $interventionType->delete();

        return redirect('/intervention-types')->with('success', 'Type d\'intervention supprimé avec succès !');
    }

    public function clear()
    {
        InterventionType::truncate();

        return redirect('/intervention-types')->with('success', 'Tous les types d\'interventions ont été supprimés !');
    }
}
