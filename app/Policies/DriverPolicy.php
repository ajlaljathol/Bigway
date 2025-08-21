<?php

namespace App\Policies;

use App\Models\Driver;
use App\Models\User;

class DriverPolicy
{
    /**
     * Determine whether the user can view any drivers.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view a specific driver.
     */
    public function view(User $user, Driver $driver): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'driver' && $user->id === $driver->user_id);
    }

    /**
     * Determine whether the user can create drivers.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update a driver.
     */
    public function update(User $user, Driver $driver): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'driver' && $user->id === $driver->user_id);
    }

    /**
     * Determine whether the user can delete a driver.
     */
    public function delete(User $user, Driver $driver): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore a driver.
     */
    public function restore(User $user, Driver $driver): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete a driver.
     */
    public function forceDelete(User $user, Driver $driver): bool
    {
        return $user->role === 'admin';
    }
}
