<?php

namespace App\Http\Controllers;

use App\Models\School;
use illuminate\Http\Request;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;

class SchoolController extends Controller
{

    public function index()
    {
        return response()->json(School::all());
    }

    public function show($id)
    {
        return response()->json(School::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'contract_type' => 'nullable|string',
            'payment_status' => 'nullable|string',
            'address' => 'nullable|string',
            'contact' => 'nullable|string',
            'total_amount' => 'nullable|numeric'
        ]);

        $school = School::create($validated);
        return response()->json($school, 201);
    }

    public function update(Request $request, $id)
    {
        $school = School::findOrFail($id);
        $school->update($request->all());
        return response()->json($school);
    }

    public function destroy($id)
    {
        School::destroy($id);
        return response()->json(['message' => 'School deleted']);
    }
}
