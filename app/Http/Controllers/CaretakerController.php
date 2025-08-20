<?php

namespace App\Http\Controllers;

use App\Models\Caretaker;
use App\Models\Staff;
use App\Models\Salary;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CaretakerController extends Controller
{
    /**
     * Display a listing of caretakers.
     */
    public function index()
    {
        $caretakers = Caretaker::with(['staff', 'salary', 'vehicle'])->latest()->get();
        return view('caretakers.index', compact('caretakers'));
    }

    /**
     * Show the form for creating a new caretaker.
     */
    public function create()
    {
        $staff = Staff::all();
        $salaries = Salary::all();
        $vehicles = Vehicle::all();

        return view('caretakers.create', compact('staff', 'salaries', 'vehicles'));
    }

    /**
     * Store a newly created caretaker in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'staff_id'  => 'required|exists:staff,id',
            'salary_id' => 'required|exists:salaries,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        Caretaker::create($request->only(['name', 'staff_id', 'salary_id', 'vehicle_id']));

        return redirect()->route('caretakers.index')->with('success', 'Caretaker added successfully.');
    }

    /**
     * Display the specified caretaker.
     */
    public function show(Caretaker $caretaker)
    {
        return view('caretakers.show', compact('caretaker'));
    }

    /**
     * Show the form for editing the specified caretaker.
     */
    public function edit(Caretaker $caretaker)
    {
        $staff = Staff::all();
        $salaries = Salary::all();
        $vehicles = Vehicle::all();

        return view('caretakers.edit', compact('caretaker', 'staff', 'salaries', 'vehicles'));
    }

    /**
     * Update the specified caretaker in storage.
     */
    public function update(Request $request, Caretaker $caretaker)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'staff_id'  => 'required|exists:staff,id',
            'salary_id' => 'required|exists:salaries,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $caretaker->update($request->only(['name', 'staff_id', 'salary_id', 'vehicle_id']));

        return redirect()->route('caretakers.index')->with('success', 'Caretaker updated successfully.');
    }

    /**
     * Remove the specified caretaker from storage.
     */
    public function destroy(Caretaker $caretaker)
    {
        $caretaker->delete();

        return redirect()->route('caretakers.index')->with('success', 'Caretaker deleted successfully.');
    }
}
