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
use App\Models\Caretaker;

// Home route
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('students', StudentController::class);

Route::resource('guardians', GuardianController::class);

Route::resource('schools', SchoolController::class);

Route::resource('caretakers', CaretakerController::class);

Route::resource('drivers', DriverController::class);

Route::resource('salaries', SalaryController::class);

Route::resource('vehicles', VehicleController::class);

Route::resource('attendances', AttendanceController::class);

Route::resource('staffs', StaffController::class);

Route::resource('expenses', ExpenseController::class);

Route::resource('routes', RouteController::class);
