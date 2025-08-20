<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        //$routes = Route::with('vehicle')->latest()->get();
        return view('routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new route.
     */
    public function create()
    {
        $vehicles = Vehicle::all();
        return view('routes.create', compact('vehicles'));
    }

    /**
     * Store a newly created route in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'starting_time'  => 'required|date_format:H:i',
            'total_distance' => 'required|integer|min:1',
           // 'vehicle_id'     => 'required|exists:vehicles,id',
        ]);

        Route::create($request->all());

        return redirect()->route('routes.index')->with('success', 'Route created successfully.');
    }

    /**
     * Display the specified route.
     */
    public function show(Route $route)
    {
        //$route->load('vehicle');
        return view('routes.show', compact('route'));
    }

    /**
     * Show the form for editing the specified route.
     */
    public function edit(Route $route)
    {
        //$vehicles = Vehicle::all();
        return view('routes.edit', compact('route', 'vehicles'));
    }

    /**
     * Update the specified route in storage.
     */
    public function update(Request $request, Route $route)
    {
        $request->validate([
            'starting_time'  => 'required|date_format:H:i',
            'total_distance' => 'required|integer|min:1',
          //  'vehicle_id'     => 'required|exists:vehicles,id',
        ]);

        $route->update($request->all());

        return redirect()->route('routes.index')->with('success', 'Route updated successfully.');
    }

    /**
     * Remove the specified route from storage.
     */
    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
    }
}
