<?php

namespace App\Http\Controllers;

use App\Models\Driver;
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
        $users = User::all();
        $salaries = Salary::all();

        return view('drivers.create', compact('users', 'salaries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'user_id'   => 'nullable|exists:users,id',
            'salary_id' => 'nullable|exists:salaries,id',
        ]);

        $staff = Staff::create([
            'name'     => $request->name,
            'position' => 'Driver',
        ]);

        Driver::create([
            'name'      => $request->name,
            'staff_id'  => $staff->id,
            'user_id'   => $request->user_id,
            'salary_id' => $request->salary_id,
        ]);

        return redirect()->route('drivers.index')->with('success', 'Driver added successfully.');
    }

    public function edit(Driver $driver)
    {
        $users = User::all();
        $salaries = Salary::all();

        return view('drivers.edit', compact('driver', 'users', 'salaries'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'user_id'   => 'nullable|exists:users,id',
            'salary_id' => 'nullable|exists:salaries,id',
        ]);

        $driver->update([
            'name'      => $request->name,
            'user_id'   => $request->user_id,
            'salary_id' => $request->salary_id,
        ]);

        if ($driver->staff) {
            $driver->staff->update([
                'name'     => $request->name,
                'position' => 'Driver',
            ]);
        }

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->staff) {
            $driver->staff->delete();
        }

        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }
}
