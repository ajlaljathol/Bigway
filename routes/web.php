<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CaretakerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\AdminController;

// Public home / welcome
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (login, register, password reset...)
Auth::routes();

Route::middleware(['auth'])->group(function () {

    // Shared dashboard for non-admins (and default landing for guardians/students/staff)
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Admin dashboard (AdminController::dashboard should check role server-side)
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminController::class, 'StaffIndex'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'usersCreate'])->name('users.create');
        Route::post('/users', [AdminController::class, 'usersStore'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'usersEdit'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'usersUpdate'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'usersDestroy'])->name('users.destroy');
    });

    Route::resource('students', StudentController::class);
    Route::resource('guardians', GuardianController::class);
    Route::resource('schools', SchoolController::class);
    Route::resource('caretakers', CaretakerController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('salaries', SalaryController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('routes', RouteController::class);

    // extra attendance route
    Route::get('/attendance/students/{vehicle}', [AttendanceController::class, 'getStudents'])
        ->name('attendance.getStudents');
});
