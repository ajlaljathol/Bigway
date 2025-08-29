<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Vehicle;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Show attendance creation form.
     */
    public function create()
    {
        $vehicles = Vehicle::all();

        return view('attendance.create', compact('vehicles'));
    }

    /**
     * Store attendance records.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'date'       => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'vehicle_id' => $request->vehicle_id,
                    'date'       => $request->date,
                ],
                [
                    'school_id'  => Student::find($studentId)->school_id ?? null,
                    'status'     => $status,
                ]
            );
        }

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance marked successfully.');
    }

    /**
     * List all attendance records.
     */
    public function index()
    {
        // Group by date and vehicle for easy reporting
        $attendances = Attendance::with(['student', 'vehicle'])
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->date . '-' . $item->vehicle_id;
            });

        return view('attendance.index', compact('attendances'));
    }

    /**
     * API endpoint: fetch students by vehicle.
     */
    public function getStudentsByVehicle($vehicleId)
    {
        $students = Student::where('vehicle_id', $vehicleId)->get();

        return response()->json($students);
    }
}
