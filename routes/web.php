<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\VehicleController;


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

// Vehicle routes
Route::prefix('admin')->group(function () {
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicle.index');
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicle.delete');
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::patch('/admin/vehicles/{vehicle}/status', [VehicleController::class, 'updateStatus'])->name('vehicle.status');
});


