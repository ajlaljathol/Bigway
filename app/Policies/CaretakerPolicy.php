<?php

namespace App\Policies;

use App\Models\Caretaker;
use App\Models\User;

class CaretakerPolicy
{
    /**
     * Determine whether the user can view any caretakers.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view a specific caretaker.
     */
    public function view(User $user, Caretaker $caretaker): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'caretaker' && $user->id === $caretaker->user_id);
    }

    /**
     * Determine whether the user can create caretakers.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update a caretaker.
     */
    public function update(User $user, Caretaker $caretaker): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'caretaker' && $user->id === $caretaker->user_id);
    }

    /**
     * Determine whether the user can delete a caretaker.
     */
    public function delete(User $user, Caretaker $caretaker): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore a caretaker.
     */
    public function restore(User $user, Caretaker $caretaker): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete a caretaker.
     */
    public function forceDelete(User $user, Caretaker $caretaker): bool
    {
        return $user->role === 'admin';
    }
}
