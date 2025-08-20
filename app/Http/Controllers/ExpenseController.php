<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the expenses.
     */
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:500',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id(); 

        // Handle file upload if exists
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('expenses', 'public');
        }

        Expense::create($data);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }

    /**
     * Display the specified expense.
     */
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:500',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload if exists
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('expenses', 'public');
        }

        $expense->update($data);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified expense from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
