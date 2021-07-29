<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\PatientController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

// Patient Resource Controller Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('patients', PatientController::class);
    Route::resource('notes', NoteController::class);
    Route::put('patients/{patient}/restore', [PatientController::class, 'restore'])
        ->name('patients.restore')
        ->middleware('auth');
});
