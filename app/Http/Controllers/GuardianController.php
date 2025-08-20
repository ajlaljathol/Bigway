<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    /**
     * Display a listing of guardians.
     */
    public function index()
    {
        $guardians = Guardian::latest()->get();
        return view('guardians.index', compact('guardians'));
    }

    /**
     * Show the form for creating a new guardian.
     */
    public function create()
    {
        return view('guardians.create');
    }

    /**
     * Store a newly created guardian in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'address'      => 'required|string|max:500',
            'num_students' => 'required|integer|min:0',
            'gender'       => 'required|in:male,female,other',
        ]);

        Guardian::create([
            'name'         => $request->name,
            'address'      => $request->address,
            'num_students' => $request->num_students,
            'gender'       => $request->gender,
            'user_id'      => Auth::id(), // assign logged-in user
        ]);

        return redirect()->route('guardians.index')->with('success', 'Guardian added successfully.');
    }

    /**
     * Display the specified guardian.
     */
    public function show(Guardian $guardian)
    {
        return view('guardians.show', compact('guardian'));
    }

    /**
     * Show the form for editing the specified guardian.
     */
    public function edit(Guardian $guardian)
    {
        return view('guardians.edit', compact('guardian'));
    }

    /**
     * Update the specified guardian in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'address'      => 'required|string|max:500',
            'num_students' => 'required|integer|min:0',
            'gender'       => 'required|in:male,female,other',
        ]);

        $guardian->update([
            'name'         => $request->name,
            'address'      => $request->address,
            'num_students' => $request->num_students,
            'gender'       => $request->gender,
        ]);

        return redirect()->route('guardians.index')->with('success', 'Guardian updated successfully.');
    }

    /**
     * Remove the specified guardian from storage.
     */
    public function destroy(Guardian $guardian)
    {
        $guardian->delete();
        return redirect()->route('guardians.index')->with('success', 'Guardian deleted successfully.');
    }
}
