<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Guardian;
use App\Models\School;
use App\Models\Vehicle;
use App\Models\Route;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display all students.
     */
    public function index()
    {
        $students = Student::with(['guardian', 'school', 'vehicle'])->paginate(15);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $guardians = Guardian::all();
        $schools   = School::all();
        $vehicles  = Vehicle::all();
        $routes    = Route::all(); // ✅ FIXED: add routes

        return view('students.create', compact('guardians', 'schools', 'vehicles', 'routes'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'emergency_contact' => 'required|string|max:20',
            'blood_group'       => 'nullable|string|max:5',
            'address'           => 'nullable|string|max:500',
            'guardian_id'       => 'required|exists:guardians,id',
            'school_id'         => 'required|exists:schools,id',
            'vehicle_id'        => 'nullable|exists:vehicles,id',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $student->load(['guardian', 'school', 'vehicle']);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        $guardians = Guardian::all();
        $schools   = School::all();
        $vehicles  = Vehicle::all();
        $routes    = Route::all(); // ✅ FIXED: add routes

        return view('students.edit', compact('student', 'guardians', 'schools', 'vehicles', 'routes'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'emergency_contact' => 'required|string|max:20',
            'blood_group'       => 'nullable|string|max:5',
            'address'           => 'nullable|string|max:500',
            'guardian_id'       => 'required|exists:guardians,id',
            'school_id'         => 'required|exists:schools,id',
            'vehicle_id'        => 'nullable|exists:vehicles,id',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
