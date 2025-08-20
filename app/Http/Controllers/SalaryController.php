<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Staff;
use App\Models\Expense;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of salaries.
     */
    public function index()
    {
        // Fetch all salaries with staff + expense relation
        $salaries = Salary::with(['staff', 'expense'])->get();
        return view('salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new salary.
     */
    public function create()
    {
        $staff = Staff::all();
        $expenses = Expense::all();
        return view('salaries.create', compact('staff', 'expenses'));
    }

    /**
     * Store a newly created salary in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'staff_id'   => 'required|exists:staff,id',
            'expense_id' => 'required|exists:expenses,id',
            'salary'     => 'required|integer|min:0',
            'date'       => 'required|date',
        ]);

        Salary::create($request->all());

        return redirect()->route('salaries.index')->with('success', 'Salary record created successfully.');
    }

    /**
     * Display the specified salary.
     */
    public function show(Salary $salary)
    {
        return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified salary.
     */
    public function edit(Salary $salary)
    {
        $staff = Staff::all();
        $expenses = Expense::all();
        return view('salaries.edit', compact('salary', 'staff', 'expenses'));
    }

    /**
     * Update the specified salary in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'staff_id'   => 'required|exists:staff,id',
            'expense_id' => 'required|exists:expenses,id',
            'salary'     => 'required|integer|min:0',
            'date'       => 'required|date',
        ]);

        $salary->update($request->all());

        return redirect()->route('salaries.index')->with('success', 'Salary record updated successfully.');
    }

    /**
     * Remove the specified salary from storage.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->route('salaries.index')->with('success', 'Salary record deleted successfully.');
    }
}
