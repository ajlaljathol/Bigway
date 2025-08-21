<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;

class ExpensePolicy
{
    /**
     * Determine whether the user can view any expenses.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view a specific expense.
     */
    public function view(User $user, Expense $expense): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can create expenses.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update an expense.
     */
    public function update(User $user, Expense $expense): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete an expense.
     */
    public function delete(User $user, Expense $expense): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore an expense.
     */
    public function restore(User $user, Expense $expense): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete an expense.
     */
    public function forceDelete(User $user, Expense $expense): bool
    {
        return $user->role === 'admin';
    }
}
