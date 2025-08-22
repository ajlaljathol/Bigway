<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Guardian;
use App\Models\School;
use App\Models\Vehicle;
use App\Models\Route as BusRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $schools = School::all();
        $vehicles = Vehicle::all();
        $routes = BusRoute::all();
        $isGuardian = Auth::user()->role === 'guardian';
        $guardians = $isGuardian ? null : Guardian::all();
        return view('students.create', compact('schools', 'vehicles', 'routes', 'isGuardian', 'guardians'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        // Calls StudentPolicy::create()
        $isGuardian = Auth::user()->role === 'guardian';

        $rules = [
            'name' => 'required|string|max:255',
            'emerg_contact' => 'required|integer',
            'blood_grp' => 'required|string|max:5',
            'address' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
        ];

        if (!$isGuardian) {
            $rules['guardian_id'] = 'required|exists:guardians,id';
        }

        $request->validate($rules);

        $data = $request->only([
            'name',
            'emerg_contact',
            'blood_grp',
            'address',
            'school_id',
            'vehicle_id',
            'route_id',
        ]);

        if ($isGuardian) {
            $data['guardian_id'] = Auth::user()->guardian->id;
        } else {
            $data['guardian_id'] = $request->guardian_id;
        }

        Student::create($data);

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
        $schools = School::all();
        $vehicles = Vehicle::all();
        $routes = BusRoute::all();
        $isGuardian = Auth::user()->role === 'guardian';
        $guardians = $isGuardian ? null : Guardian::all();
        return view('students.edit', compact('student', 'schools', 'vehicles', 'routes', 'isGuardian', 'guardians'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Calls StudentPolicy::update()
        $isGuardian = Auth::user()->role === 'guardian';

        $rules = [
            'name' => 'required|string|max:255',
            'emerg_contact' => 'required|integer',
            'blood_grp' => 'required|string|max:5',
            'address' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
        ];

        if (!$isGuardian) {
            $rules['guardian_id'] = 'required|exists:guardians,id';
        }

        $request->validate($rules);

        $data = $request->only([
            'name',
            'emerg_contact',
            'blood_grp',
            'address',
            'school_id',
            'vehicle_id',
            'route_id',
        ]);

        if ($isGuardian) {
            $data['guardian_id'] = Auth::user()->guardian->id;
        } else {
            $data['guardian_id'] = $request->guardian_id;
        }

        $student->update($data);

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
