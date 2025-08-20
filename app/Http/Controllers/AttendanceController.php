<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\School;
use App\Models\Student;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the attendance records.
     */
    public function index()
    {
        // make sure Attendance model has relations: student(), school(), vehicle()
        $attendances = Attendance::with(['student', 'school', 'vehicle'])->latest()->get();
        return view('attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new attendance record.
     */
    public function create()
    {
        $students = Student::all();
        $schools = School::all();
        $vehicles = Vehicle::all();

        return view('attendance.create', compact('students', 'schools', 'vehicles'));
    }

    /**
     * Store a newly created attendance record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id'    => 'required|exists:students,id',
            'school_id'     => 'required|exists:schools,id',
            'vehicle_id'    => 'required|exists:vehicles,id',
            'date'          => 'required|date',
            'home_pickup'   => 'required|string|max:255',
            'school_pickup' => 'required|string|max:255',
            'home_drop'     => 'required|string|max:255',
            'school_drop'   => 'required|string|max:255',
        ]);

        Attendance::create($request->only([
            'student_id',
            'school_id',
            'vehicle_id',
            'date',
            'home_pickup',
            'school_pickup',
            'home_drop',
            'school_drop',
        ]));

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance marked successfully.');
    }

    /**
     * Show a single attendance record.
     */
    public function show(Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing an attendance record.
     */
    public function edit(Attendance $attendance)
    {
        $students = Student::all();
        $schools = School::all();
        $vehicles = Vehicle::all();

        return view('attendance.edit', compact('attendance', 'students', 'schools', 'vehicles'));
    }

    /**
     * Update an attendance record.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'student_id'    => 'required|exists:students,id',
            'school_id'     => 'required|exists:schools,id',
            'vehicle_id'    => 'required|exists:vehicles,id',
            'date'          => 'required|date',
            'home_pickup'   => 'required|string|max:255',
            'school_pickup' => 'required|string|max:255',
            'home_drop'     => 'required|string|max:255',
            'school_drop'   => 'required|string|max:255',
        ]);

        $attendance->update($request->only([
            'student_id',
            'school_id',
            'vehicle_id',
            'date',
            'home_pickup',
            'school_pickup',
            'home_drop',
            'school_drop',
        ]));

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove an attendance record.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance deleted successfully.');
    }
}
