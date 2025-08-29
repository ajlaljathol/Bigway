<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Staff;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    /**
     * Display a listing of salaries.
     */
    public function index()
    {
        $salaries = Salary::with(['staff', 'expense'])->latest()->get();
        return view('salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new salary.
     */
    public function create()
    {
        $staff = Staff::all();
        return view('salaries.create', compact('staff'));
    }

    /**
     * Store a newly created salary in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'amount'   => 'required|numeric',
            'date'     => 'required|date',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Step 1: Create Salary first
        $salary = Salary::create([
            'staff_id' => $request->staff_id,
            'amount'   => $request->amount,
            'date'     => $request->date,
        ]);

        // Step 2: Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('expenses', 'public');
        }

        // Step 3: Create Expense and attach salary_id
        $expense = Expense::create([
            'date'        => $request->date,
            'amount'      => $request->amount,
            'description' => 'Salary Payment for Staff ID ' . $request->staff_id,
            'type'        => 'salary',
            'user_id'     => Auth::id(),
            'salary_id'   => $salary->id,
            'image'       => $imagePath,
        ]);

        // Step 4: Update Salary with Expense ID
        $salary->update(['expense_id' => $expense->id]);

        return redirect()->route('salaries.index')->with('success', 'Salary & Expense created successfully.');
    }


    /**
     * Display the specified salary.
     */
    public function show(Salary $salary)
    {
        $salary->load(['staff', 'expense']);
        return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified salary.
     */
    public function edit(Salary $salary)
    {
        $staff = Staff::all();
        return view('salaries.edit', compact('salary', 'staff'));
    }

    /**
     * Update the specified salary in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $validated = $request->validate([
            'staff_id'   => 'required|exists:staff,id',
            'amount'     => 'required|numeric|min:0',
            'date'       => 'required|date',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle optional image update
        $imagePath = $salary->expense->image ?? null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('expenses', 'public');
        }

        // Update Salary
        $salary->update([
            'staff_id'   => $validated['staff_id'],
            'amount'     => $validated['amount'],
            'date'       => $validated['date'],
        ]);

        // Update related Expense
        if ($salary->expense) {
            $salary->expense->update([
                'date'        => $validated['date'],
                'amount'      => $validated['amount'],
                'description' => 'Salary for staff ID: ' . $validated['staff_id'],
                'type'        => 'salary',
                'user_id'     => Auth::id(),   // keep user reference
                'image'       => $imagePath,
            ]);
        }

        return redirect()->route('salaries.index')
            ->with('success', 'Salary record (and expense) updated successfully.');
    }

    /**
     * Remove the specified salary from storage.
     */
    public function destroy(Salary $salary)
    {
        // Delete linked expense too
        if ($salary->expense) {
            $salary->expense->delete();
        }

        $salary->delete();

        return redirect()->route('salaries.index')
            ->with('success', 'Salary record and related expense deleted successfully.');
    }
}
