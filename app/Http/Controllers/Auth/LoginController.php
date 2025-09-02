<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login based on role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => '/admin/dashboard',
            'staff' => '/staff/dashboard',
            'student' => '/student/dashboard',
            'guardian' => '/guardian/dashboard',
            default => '/home',
        };
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
