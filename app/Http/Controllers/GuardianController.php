<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    public function __construct()
    {
        // Apply policy automatically for all resource methods
        $this->authorizeResource(Guardian::class, 'guardian');
    }

    /**
     * Display a listing of guardians.
     */
    public function index()
    {
        $this->authorize('viewAny', Guardian::class);

        $guardians = Guardian::withCount('students')->latest()->get();
        return view('guardians.index', compact('guardians'));
    }

    /**
     * Show the form for creating a new guardian.
     */
    public function create()
    {
        $this->authorize('create', Guardian::class);

        return view('guardians.create');
    }

    /**
     * Store a newly created guardian in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Guardian::class);

        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'gender'  => 'required|in:male,female,other',
            'students.*.name'   => 'sometimes|string|max:255',
            'students.*.gender' => 'sometimes|in:male,female,other',
            'students.*.age'    => 'sometimes|integer|min:1',
        ]);

        $guardian = Guardian::create([
            'name'    => $request->name,
            'address' => $request->address,
            'gender'  => $request->gender,
            'user_id' => Auth::id(),
        ]);

        if ($request->has('students')) {
            foreach ($request->students as $studentData) {
                if (!empty($studentData['name'])) {
                    Student::create([
                        'name'        => $studentData['name'],
                        'gender'      => $studentData['gender'] ?? null,
                        'age'         => $studentData['age'] ?? null,
                        'guardian_id' => $guardian->id,
                    ]);
                }
            }
        }

        return redirect()->route('guardians.index')->with('success', 'Guardian and children added successfully.');
    }

    /**
     * Display the specified guardian.
     */
    public function show(Guardian $guardian)
    {
        $this->authorize('view', $guardian);

        $guardian->load('students');
        return view('guardians.show', compact('guardian'));
    }

    /**
     * Show the form for editing the specified guardian.
     */
    public function edit(Guardian $guardian)
    {
        $this->authorize('update', $guardian);

        $guardian->load('students');
        return view('guardians.edit', compact('guardian'));
    }

    /**
     * Update the specified guardian in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        $this->authorize('update', $guardian);

        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'gender'  => 'required|in:male,female,other',
            'students.*.name'   => 'sometimes|string|max:255',
            'students.*.gender' => 'sometimes|in:male,female,other',
            'students.*.age'    => 'sometimes|integer|min:1',
        ]);

        $guardian->update([
            'name'    => $request->name,
            'address' => $request->address,
            'gender'  => $request->gender,
        ]);

        if ($request->has('students')) {
            foreach ($request->students as $studentData) {
                if (!empty($studentData['id'])) {
                    $student = Student::find($studentData['id']);
                    if ($student && $student->guardian_id == $guardian->id) {
                        $student->update($studentData);
                    }
                } elseif (!empty($studentData['name'])) {
                    Student::create([
                        'name'        => $studentData['name'],
                        'gender'      => $studentData['gender'] ?? null,
                        'age'         => $studentData['age'] ?? null,
                        'guardian_id' => $guardian->id,
                    ]);
                }
            }
        }

        return redirect()->route('guardians.index')->with('success', 'Guardian updated successfully.');
    }

    /**
     * Remove the specified guardian from storage.
     */
    public function destroy(Guardian $guardian)
    {
        $this->authorize('delete', $guardian);

        $guardian->delete();
        return redirect()->route('guardians.index')->with('success', 'Guardian deleted successfully.');
    }
}
