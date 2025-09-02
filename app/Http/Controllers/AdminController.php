<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // only logged-in users
    }


    /**
     * Ensure the current user is an admin
     */
    private function authorizeAdmin()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Admin dashboard
     */
    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user || !$user->isAdmin()) {
            return redirect('/home')->with('error', 'Access denied.');
        }

        return view('admin.dashboard');
    }

    /**
     * List all users
     */
    public function usersIndex()
    {
        $this->authorizeAdmin();

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show form to create a new user
     */
    public function usersCreate()
    {
        $this->authorizeAdmin();

        return view('admin.users.create');
    }

    /**
     * Store a new user
     */
    public function usersStore(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,staff,guardian,student,caretaker,driver',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }
}
