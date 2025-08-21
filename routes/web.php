<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\SchoolController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Student resource routes (with policy enforcement in controller)
Route::resource('students', StudentController::class);

// Guardian resource routes (if you have a GuardianController)
Route::resource('guardians', GuardianController::class);

// School resource routes (if you have a SchoolController)
Route::resource('schools', SchoolController::class);
