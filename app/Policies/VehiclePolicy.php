<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;

class VehiclePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin, driver, caretaker, student, guardian can view vehicles
        return in_array($user->role, ['admin', 'driver', 'caretaker', 'student', 'guardian']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vehicle $vehicle): bool
    {
        // Same as viewAny, all these roles can view
        return in_array($user->role, ['admin', 'driver', 'caretaker', 'student', 'guardian']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only admin can create vehicles
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vehicle $vehicle): bool
    {
        // Only admin can update
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vehicle $vehicle): bool
    {
        // Only admin can delete
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vehicle $vehicle): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vehicle $vehicle): bool
    {
        return $user->role === 'admin';
    }
}
