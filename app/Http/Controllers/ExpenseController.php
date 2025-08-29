<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    /**
     * Display a listing of expenses with pagination.
     */
    public function index()
    {
        $expenses = Expense::latest()->paginate(20); // paginate 20 per page
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

        $data = $request->only(['date', 'amount', 'description', 'type']);
        $data['user_id'] = Auth::id();

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
        // Authorization: only owner can edit
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        // Authorization: only owner can update
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:500',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['date', 'amount', 'description', 'type']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($expense->image) {
                Storage::disk('public')->delete($expense->image);
            }
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
        // Authorization: only owner can delete
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete associated image
        if ($expense->image) {
            Storage::disk('public')->delete($expense->image);
        }

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
