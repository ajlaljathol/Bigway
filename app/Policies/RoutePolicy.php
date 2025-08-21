<?php

namespace App\Policies;

use App\Models\Route;
use App\Models\User;

class RoutePolicy
{
    /**
     * Determine whether the user can view any routes.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'driver', 'guardian', 'student']);
    }

    /**
     * Determine whether the user can view a specific route.
     */
    public function view(User $user, Route $route): bool
    {
        return in_array($user->role, ['admin', 'driver', 'guardian', 'student']);
    }

    /**
     * Determine whether the user can create routes.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'driver']);
    }

    /**
     * Determine whether the user can update a route.
     */
    public function update(User $user, Route $route): bool
    {
        return in_array($user->role, ['admin', 'driver']);
    }

    /**
     * Determine whether the user can delete a route.
     */
    public function delete(User $user, Route $route): bool
    {
        return in_array($user->role, ['admin', 'driver']);
    }

    /**
     * Determine whether the user can restore a route.
     */
    public function restore(User $user, Route $route): bool
    {
        return in_array($user->role, ['admin', 'driver']);
    }

    /**
     * Determine whether the user can permanently delete a route.
     */
    public function forceDelete(User $user, Route $route): bool
    {
        return in_array($user->role, ['admin', 'driver']);
    }
}
