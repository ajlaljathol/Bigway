<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Student;

class StudentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin can view all students
        return $user->role === 'admin' || $user->role === 'guardian';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Student $student): bool
    {
        // Admin can view all students
        if ($user->role === 'admin') {
            return true;
        }

        // Guardian can only view their own children
        if ($user->role === 'guardian') {
            return $user->id === $student->guardian->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admin & Guardian both can create students
        return $user->role === 'admin' || $user->role === 'guardian';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Student $student): bool
    {
        // Admin can update any student
        if ($user->role === 'admin') {
            return true;
        }

        // Guardian can update only their own children
        if ($user->role === 'guardian') {
            return $user->id === $student->guardian->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Student $student): bool
    {
        // Admin can delete any student
        if ($user->role === 'admin') {
            return true;
        }

        // Guardian can delete only their own children
        if ($user->role === 'guardian') {
            return $user->id === $student->guardian->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Student $student): bool
    {
        return $this->delete($user, $student);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Student $student): bool
    {
        return $this->delete($user, $student);
    }
}
