<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationFormController;

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

// Application form routes
Route::get('/', [ApplicationFormController::class, 'index'])->name('form.index');
Route::post('/submit-application', [ApplicationFormController::class, 'submit'])->name('form.submit');
Route::get('/application-status/{id}', [ApplicationFormController::class, 'status'])->name('form.status');

// User form route (protected)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/userform', function () {
        return view('userview.userForm');
    })->name('user.form');
});

// Admin routes
Route::get('/admin', function () {
    return view('adminview.index');
})->name('admin.dashboard');

// Dashboard routes (protected by authentication)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
