<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;

class SchoolPolicy
{
    /**
     * Determine whether the user can view any schools.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view a specific school.
     */
    public function view(User $user, School $school): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can create schools.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update a school.
     */
    public function update(User $user, School $school): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete a school.
     */
    public function delete(User $user, School $school): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore a school.
     */
    public function restore(User $user, School $school): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete a school.
     */
    public function forceDelete(User $user, School $school): bool
    {
        return $user->role === 'admin';
    }
}
