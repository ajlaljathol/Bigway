<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Salary;
use App\Models\Vehicle;
use App\Models\Caretaker;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of staff.
     */
    public function index()
    {
        // Eager-load salary and vehicle
        $staff = Staff::with(['salary', 'vehicle'])->latest()->get();

        return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        $salaries = Salary::all();
        $vehicles = Vehicle::all();

        return view('staff.create', compact('salaries', 'vehicles'));
    }

    /**
     * Store a newly created staff member in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'required|string|max:50',
            'position'  => 'nullable|string|max:255',
            'cnic'      => 'nullable|string|max:15',
            'phone'     => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:255',
            'salary_id' => 'nullable|exists:salaries,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        $staff = Staff::create($request->only([
            'name',
            'role',
            'position',
            'cnic',
            'phone',
            'address',
            'salary_id',
            'vehicle_id'
        ]));

        // If staff is a caretaker, also create caretaker record
        if (strtolower($staff->position) === 'caretaker') {
            Caretaker::create([
                'staff_id'   => $staff->id,
                'salary_id'  => $staff->salary_id,
                'vehicle_id' => $staff->vehicle_id,
            ]);
        }

        return redirect()->route('staff.index')->with('success', 'Staff member created successfully.');
    }

    /**
     * Display the specified staff member.
     */
    public function show(Staff $staff)
    {
        $staff->load(['salary', 'vehicle']);
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff member.
     */
    public function edit(Staff $staff)
    {
        $salaries = Salary::all();
        $vehicles = Vehicle::all();

        return view('staff.edit', compact('staff', 'salaries', 'vehicles'));
    }

    /**
     * Update the specified staff member in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'required|string|max:50',
            'position'  => 'nullable|string|max:255',
            'cnic'      => 'nullable|string|max:15',
            'phone'     => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:255',
            'salary_id' => 'nullable|exists:salaries,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        $staff->update($request->only([
            'name',
            'role',
            'position',
            'cnic',
            'phone',
            'address',
            'salary_id',
            'vehicle_id'
        ]));

        if (strtolower($staff->position) === 'caretaker') {
            Caretaker::updateOrCreate(
                ['staff_id' => $staff->id],
                [
                    'salary_id'  => $staff->salary_id,
                    'vehicle_id' => $staff->vehicle_id,
                ]
            );
        } else {
            // if staff changed role away from caretaker, remove caretaker record
            $staff->caretaker()?->delete();
        }

        return redirect()->route('staff.index')->with('success', 'Staff member updated successfully.');
    }


    /**
     * Remove the specified staff member from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff member deleted successfully.');
    }
}
