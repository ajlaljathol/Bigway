<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Guardian;
use App\Models\School;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        // This automatically applies StudentPolicy methods
        $this->authorizeResource(Student::class, 'student');
    }

    /**
     * Display a listing of students.
     */
    public function index()
    {
        // Calls StudentPolicy::viewAny()
        $students = Student::with(['guardian', 'school'])->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        // Calls StudentPolicy::create()
        $guardians = Guardian::all();
        $schools = School::all();
        return view('students.create', compact('guardians', 'schools'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        // Calls StudentPolicy::create()
        $request->validate([
            'name' => 'required|string|max:255',
            'emerg_contact' => 'required|integer',
            'blood_grp' => 'required|string|max:5',
            'address' => 'required|string|max:255',
            'guardian_id' => 'required|exists:guardians,id',
            'school_id' => 'required|exists:schools,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
        ]);

        Student::create($request->only([
            'name',
            'emerg_contact',
            'blood_grp',
            'address',
            'guardian_id',
            'school_id',
            'vehicle_id',
            'route_id',
        ]));

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        // Calls StudentPolicy::view()
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        // Calls StudentPolicy::update()
        $guardians = Guardian::all();
        $schools = School::all();
        return view('students.edit', compact('student', 'guardians', 'schools'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Calls StudentPolicy::update()
        $request->validate([
            'name' => 'required|string|max:255',
            'emerg_contact' => 'required|integer',
            'blood_grp' => 'required|string|max:5',
            'address' => 'required|string|max:255',
            'guardian_id' => 'required|exists:guardians,id',
            'school_id' => 'required|exists:schools,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
        ]);

        $student->update($request->only([
            'name',
            'emerg_contact',
            'blood_grp',
            'address',
            'guardian_id',
            'school_id',
            'vehicle_id',
            'route_id',
        ]));

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        // Calls StudentPolicy::delete()
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
