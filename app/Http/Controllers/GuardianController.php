<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Student;
use App\Models\School;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Guardian::class, 'guardian');
    }

    /**
     * Show all guardians.
     */
    public function index()
    {
        $guardians = Guardian::with('students')->latest()->paginate(15);
        return view('guardians.index', compact('guardians'));
    }

    /**
     * Show the form for creating guardian + student(s).
     */
    public function create()
    {
        $schools  = School::all();
        $vehicles = Vehicle::all();

        return view('guardians.create', compact('schools', 'vehicles'));
    }

    /**
     * Store guardian + student(s).
     */
    public function store(Request $request)
    {
        $request->validate([
            // Guardian fields
            'name'           => 'required|string|max:255',
            'address'        => 'required|string|max:500',
            'gender'         => 'required|in:male,female,other',
            'relation'       => 'required|string|max:100',
            'contact_number' => 'required|string|max:20',

            // Student fields
            'students'                     => 'required|array|min:1',
            'students.*.name'              => 'required|string|max:255',
            'students.*.emergency_contact' => 'required|string|max:20',
            'students.*.blood_group'       => 'nullable|string|max:5',
            'students.*.address'           => 'nullable|string|max:500',
            'students.*.school_id'         => 'required|exists:schools,id',
            'students.*.vehicle_id'        => 'required|exists:vehicles,id', // must be required because migration demands it
        ]);

        // Step 1: Create guardian
        $guardian = Guardian::create([
            'name'           => $request->name,
            'address'        => $request->address,
            'gender'         => $request->gender,
            'relation'       => $request->relation,
            'contact_number' => $request->contact_number,
            'user_id'        => Auth::id(),
        ]);

        // Step 2: Create linked students
        foreach ($request->students as $studentData) {
            Student::create([
                'name'              => $studentData['name'],
                'emergency_contact' => $studentData['emergency_contact'],
                'blood_group'       => $studentData['blood_group'] ?? null,
                'address'           => $studentData['address'] ?? null,
                'school_id'         => $studentData['school_id'],
                'vehicle_id'        => $studentData['vehicle_id'], // no longer nullable
                'guardian_id'       => $guardian->id,
            ]);
        }

        return redirect()->route('guardians.index')
            ->with('success', 'Guardian and student(s) created successfully.');
    }

    public function show(Guardian $guardian)
    {
        // Eager load related students, their school, and vehicle
        $guardian->load(['students.school', 'students.vehicle']);

        return view('guardians.show', compact('guardian'));
    }
}
