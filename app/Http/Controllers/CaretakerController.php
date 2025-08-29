<?php

namespace App\Http\Controllers;

use App\Models\Caretaker;
use App\Models\Staff;
use App\Models\Salary;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CaretakerController extends Controller
{
    public function index()
    {
        // Get all caretakers with related staff, salary, and vehicle
        $caretakers = Caretaker::with(['staff', 'salary', 'vehicle'])
            ->latest()
            ->get();

        return view('caretakers.index', compact('caretakers'));
    }



    public function edit(Caretaker $caretaker)
    {
        $salaries = Salary::all();
        $vehicles = Vehicle::all();

        return view('caretakers.edit', compact('caretaker', 'salaries', 'vehicles'));
    }

    public function update(Request $request, Caretaker $caretaker)
    {
        $request->validate([
            'salary_id'  => 'required|exists:salaries,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        // update caretaker details
        $caretaker->update([
            'salary_id'  => $request->salary_id,
            'vehicle_id' => $request->vehicle_id,
        ]);

        return redirect()->route('caretakers.index')->with('success', 'Caretaker updated successfully.');
    }
}
