<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\AdminController;


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

// Application form routes (redirect to login)
Route::get('/', function () {
    return redirect()->route('login');
})->name('form.index');
Route::post('/submit-application', [ApplicationFormController::class, 'submit'])->name('form.submit');
Route::get('/application-status/{id}', [ApplicationFormController::class, 'status'])->name('form.status');

// User form route (protected)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'redirect.usertype'
])->group(function () {
    Route::get('/userform', function () {
        return view('userview.userForm');
    })->name('user.form');
});

// Admin routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'redirect.usertype'
])->group(function () {
    Route::get('/admin', function () {
        return view('adminview.index');
    })->name('admin.dashboard');
    
    // User Management Routes
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users');
    Route::patch('/admin/users/{user}/update-type', [UserManagementController::class, 'updateUserType'])->name('admin.users.update-type');
    Route::get('/admin/users/{user}', [UserManagementController::class, 'show'])->name('admin.users.show');
});

// Dashboard routes (protected by authentication)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'redirect.usertype'
])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // User Management Routes
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users');
    Route::patch('/admin/users/{user}/update-type', [UserManagementController::class, 'updateUserType'])->name('admin.users.update-type');
    Route::get('/admin/users/{user}', [UserManagementController::class, 'show'])->name('admin.users.show');
});

// Vehicle routes
Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'redirect.usertype'
])->group(function () {
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicle.index');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicle.delete');
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::patch('/admin/vehicles/{vehicle}/status', [VehicleController::class, 'updateStatus'])->name('vehicle.status');
});

Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::put('/applicants/{id}/status', [AdminController::class, 'updateStatus'])
     ->name('applicants.updateStatus');


