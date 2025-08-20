<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\School;
use App\Models\Caretaker;
use App\Models\Driver;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::with(['school', 'caretaker', 'driver'])->get();
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        $schools = School::all();
        $caretakers = Caretaker::all();
        $drivers = Driver::all();
        return view('vehicles.create', compact('schools', 'caretakers', 'drivers'));
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'num_seats'    => 'required|integer|min:1',
            'school_id'    => 'required|exists:schools,id',
            'route_id'     => 'required|exists:routes,id',
            'ownership'    => 'required|string|max:255',
            'caretaker_id' => 'required|exists:caretakers,id',
            'driver_id'    => 'required|exists:drivers,id',
            'reg_number'   => 'required|string|max:255|unique:vehicles,reg_number',
            'rent'         => 'required|numeric|min:0',
            'vehicle_type' => 'required|string|max:255',
        ]);

        Vehicle::create($request->only([
            'num_seats',
            'school_id',
            'route_id',
            'ownership',
            'caretaker_id',
            'driver_id',
            'reg_number',
            'rent',
            'vehicle_type'
        ]));

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified vehicle.
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehicle $vehicle)
    {
        $schools = School::all();
        $caretakers = Caretaker::all();
        $drivers = Driver::all();
        return view('vehicles.edit', compact('vehicle', 'schools', 'caretakers', 'drivers'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'num_seats'    => 'required|integer|min:1',
            'school_id'    => 'required|exists:schools,id',
            'route_id'     => 'required|exists:routes,id',
            'ownership'    => 'required|string|max:255',
            'caretaker_id' => 'required|exists:caretakers,id',
            'driver_id'    => 'required|exists:drivers,id',
            'reg_number'   => 'required|string|max:255|unique:vehicles,reg_number,' . $vehicle->id,
            'rent'         => 'required|numeric|min:0',
            'vehicle_type' => 'required|string|max:255',
        ]);

        $vehicle->update($request->only([
            'num_seats',
            'school_id',
            'route_id',
            'ownership',
            'caretaker_id',
            'driver_id',
            'reg_number',
            'rent',
            'vehicle_type'
        ]));

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
