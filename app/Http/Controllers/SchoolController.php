<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('schools.index', compact('schools'));
    }

    public function show($id)
    {
        $school = School::with('students')->findOrFail($id);
        return view('schools.show', compact('school'));
    }

    public function create()
    {
        return view('schools.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'contract_type' => 'required|string',
            'payment_status' => 'required|string',
            'address' => 'required|string',
            'contact_details' => 'required|string',
            'charges' => 'required|numeric'
        ]);

        $school = School::create($validated);
        return redirect()->route('schools.index')->with('success', 'School created successfully.');
    }

    public function edit($id)
    {
        $school = School::findOrFail($id);
        return view('schools.edit', compact('school'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'contract_type' => 'required|string',
            'payment_status' => 'required|string',
            'address' => 'required|string',
            'contact_details' => 'required|string',
            'charges' => 'required|numeric'
        ]);

        $school = School::findOrFail($id);
        $school->update($validated);
        return redirect()->route('schools.index')->with('success', 'School updated successfully.');
    }

    public function destroy($id)
    {
        School::destroy($id);
        return redirect()->route('schools.index')->with('success', 'School deleted successfully.');
    }
}
