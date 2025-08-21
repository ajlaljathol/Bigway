<?php

namespace App\Policies;

use App\Models\Guardian;
use App\Models\User;

class GuardianPolicy
{
    /**
     * Check if the user has full access (admin or guardian).
     */
    private function hasFullAccess(User $user): bool
    {
        return in_array($user->role, ['admin', 'guardian']);
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasFullAccess($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Guardian $guardian): bool
    {
        return $this->hasFullAccess($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasFullAccess($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Guardian $guardian): bool
    {
        return $this->hasFullAccess($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Guardian $guardian): bool
    {
        return $this->hasFullAccess($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Guardian $guardian): bool
    {
        return $this->hasFullAccess($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Guardian $guardian): bool
    {
        return $this->hasFullAccess($user);
    }
}
