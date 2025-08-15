<?php

use Illuminate\Support\Facades\Route;

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

    return view('userview.userForm');

});
Route::get('/user-registration', function () {
    return view('userview.userRegistration');
});

Route::get('/admin', function () {
    return view('adminview.index');
});

Route::get('/admin-registration', function () {
    return view('adminview.adminRegistration');
});

// Handle admin registration form submission - no server-side validation
Route::post('/admin-register', function () {
    // Simply redirect to admin page after form submission
    return redirect('/admin')->with('success', 'Registration successful!');
});
