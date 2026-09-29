<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HospitalController;

/*
|--------------------------------------------------------------------------
| Public hospital pages
|--------------------------------------------------------------------------
*/
Route::controller(HospitalController::class)->group(function () {
    Route::get('/',                 'home')->name('home');
    Route::get('/department',       'department')->name('department');
    Route::get('/doctor',           'doctor')->name('doctor');
    Route::get('/nurse',            'nurse')->name('nurse');
    Route::get('/monitor-hospital', 'monitorHospital')->name('monitor.hospital');
});

/*
|--------------------------------------------------------------------------
| Account pages (same route names as before)
|--------------------------------------------------------------------------
*/
Route::controller(HospitalController::class)->group(function () {
    Route::get('/login',       'login')->name('login');
    Route::get('/register',    'register')->name('register');
    Route::get('/information', 'information')->name('information');
});

// The original forms POST to home / login. Kept so the existing flow still works.
Route::post('/',      fn () => redirect()->route('home'));
Route::post('/login', fn () => redirect()->route('login'));
