<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the routes.
     */
    public function index()
    {
        // Load all routes
        $routes = Route::latest()->get();

        return view('routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new route.
     */
    public function create()
    {
        return view('routes.create');
    }

    /**
     * Store a newly created route in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'starting_time'  => 'required|date_format:H:i',
            'total_distance' => 'required|integer|min:1',
        ]);

        Route::create($request->only(['starting_time', 'total_distance']));

        return redirect()->route('routes.index')->with('success', 'Route created successfully.');
    }

    /**
     * Display the specified route.
     */
    public function show(Route $route)
    {
        return view('routes.show', compact('route'));
    }

    /**
     * Show the form for editing the specified route.
     */
    public function edit(Route $route)
    {
        return view('routes.edit', compact('route'));
    }

    /**
     * Update the specified route in storage.
     */
    public function update(Request $request, Route $route)
    {
        $request->validate([
            'starting_time'  => 'required|date_format:H:i',
            'total_distance' => 'required|integer|min:1',
        ]);

        $route->update($request->only(['starting_time', 'total_distance']));

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
