<?php

namespace App\Http\Controllers;

use App\Models\Caretaker;
use App\Models\Staff;
use App\Models\Salary;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CaretakerController extends Controller
{
    // show caretakers (as Caretaker models with relationships)
    public function index()
    {
        $caretakers = Caretaker::with(['staff', 'salary', 'vehicle'])
            ->latest()
            ->get();

        return view('caretakers.index', compact('caretakers'));
    }

    // show form to create a caretaker (pass staff filtered by role)
    public function create()
    {
        // staff members who are eligible to become caretakers
        $staff = Staff::where('role', 'Caretaker')->get();

        $salaries = Salary::all();
        $vehicles = Vehicle::all();

        return view('caretakers.create', compact('staff', 'salaries', 'vehicles'));
    }

    // store new caretaker
    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id|unique:caretakers,staff_id',
            'salary_id' => 'required|exists:salaries,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        Caretaker::create([
            'staff_id' => $request->staff_id,
            'salary_id' => $request->salary_id,
            'vehicle_id' => $request->vehicle_id,
        ]);

        return redirect()->route('caretakers.index')->with('success', 'Caretaker created successfully.');
    }

    // edit form
    public function edit(Caretaker $caretaker)
    {
        $salaries = Salary::all();
        $vehicles = Vehicle::all();

        return view('caretakers.edit', compact('caretaker', 'salaries', 'vehicles'));
    }

    // update caretaker
    public function update(Request $request, Caretaker $caretaker)
    {
        $request->validate([
            'salary_id' => 'required|exists:salaries,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $caretaker->update([
            'salary_id' => $request->salary_id,
            'vehicle_id' => $request->vehicle_id,
        ]);

        return redirect()->route('caretakers.index')->with('success', 'Caretaker updated successfully.');
    }

    // destroy caretaker
    public function destroy(Caretaker $caretaker)
    {
        $caretaker->delete();
        return redirect()->route('caretakers.index')->with('success', 'Caretaker deleted.');
    }
}
