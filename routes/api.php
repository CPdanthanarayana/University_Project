<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ApplicationMemberController;
use App\Http\Controllers\ApplicationVisitsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes for testing (remove in production)
Route::apiResource('applicants', ApplicantController::class);
Route::get('applicants/search', [ApplicantController::class, 'search']);

// Application routes with CSRF protection for web forms
Route::middleware(['web'])->group(function () {
    Route::post('applications', [ApplicationController::class, 'store'])->name('api.applications.store');
});

// API routes (for authenticated API access)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('applications', ApplicationController::class)->except(['store']);
    Route::put('applications/{application}/status', [ApplicationController::class, 'updateStatus']);
    
    Route::apiResource('applications.members', ApplicationMemberController::class)->shallow();
    Route::post('applications/{application}/members/bulk', [ApplicationMemberController::class, 'bulkStore']);
    
    Route::apiResource('applications.visits', ApplicationVisitsController::class)->shallow();
    Route::put('application-visits/{applicationVisit}/status', [ApplicationVisitsController::class, 'updateStatus']);
    Route::get('application-visits/date-range', [ApplicationVisitsController::class, 'getByDateRange']);
    
    Route::apiResource('users', UserController::class);
    Route::get('users/search', [UserController::class, 'search']);
    Route::get('dashboard', [UserController::class, 'dashboard']);
});

// Test routes for form integration
Route::get('test/form-submission', [App\Http\Controllers\TestFormController::class, 'testFormSubmission']);
Route::get('test/field-mapping', [App\Http\Controllers\TestFormController::class, 'testFieldMapping']);
