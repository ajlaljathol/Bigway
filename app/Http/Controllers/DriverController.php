<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Staff;
use App\Models\User;
use App\Models\Salary;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with(['staff', 'user', 'salary'])->latest()->get();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        //$vehicles = Vehicle::all();
        $staff = Staff::all();
        $users = User::all();
        $salaries = Salary::all();

        return view('drivers.create', compact( 'staff', 'users', 'salaries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
           // 'vehicle_id' => 'nullable|exists:vehicles,id',
            'staff_id'   => 'nullable|exists:staff,id',
            'user_id'    => 'nullable|exists:users,id',
            'salary_id'  => 'nullable|exists:salaries,id',
        ]);

        Driver::create($request->only(['name','staff_id', 'user_id', 'salary_id']));

        return redirect()->route('drivers.index')->with('success', 'Driver added successfully.');
    }

    public function edit(Driver $driver)
    {
        //$vehicles = Vehicle::all();
        $staff = Staff::all();
        $users = User::all();
        $salaries = Salary::all();

        return view('drivers.edit', compact('driver', 'staff', 'users', 'salaries'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            //'vehicle_id' => 'nullable|exists:vehicles,id',
            'staff_id'   => 'nullable|exists:staff,id',
            'user_id'    => 'nullable|exists:users,id',
            'salary_id'  => 'nullable|exists:salaries,id',
        ]);

        $driver->update($request->only(['name','staff_id', 'user_id', 'salary_id']));

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }
}
