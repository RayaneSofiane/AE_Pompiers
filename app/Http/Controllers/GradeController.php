<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return view('grade', ['grades' => $grades]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:100|unique:grades,description',
        ]);

        Grade::create($validated);
        return redirect('/grades')->with('success', 'Grade added successfully.');
    }

    public function delete($id)
    {
        Grade::find($id)->delete();
        return redirect('/grades')->with('success', 'Grade deleted successfully.');
    }

    public function clear()
    {
        Grade::truncate();
        return redirect('/grades')->with('success', 'All grades cleared successfully.');
    }
}
