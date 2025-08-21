<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Salary;

class SalaryPolicy
{
    /**
     * Determine whether the user can view any salaries.
     */
    public function viewAny(User $user): bool
    {
        // Only admin can view all salary records
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view a specific salary record.
     */
    public function view(User $user, Salary $salary): bool
    {
        // Admin can view all salaries
        if ($user->role === 'admin') {
            return true;
        }

        // Driver or Caretaker can only view their own salary record
        if (in_array($user->role, ['driver', 'caretaker'])) {
            return $salary->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create salaries.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update a salary.
     */
    public function update(User $user, Salary $salary): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete a salary.
     */
    public function delete(User $user, Salary $salary): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore a salary.
     */
    public function restore(User $user, Salary $salary): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete a salary.
     */
    public function forceDelete(User $user, Salary $salary): bool
    {
        return $user->role === 'admin';
    }
}
