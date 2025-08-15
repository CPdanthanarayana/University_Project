<?php

use App\Http\Controllers\AuthManager;
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
    return view('adminview.index');
});
Route::get('/user-registration', function () {
    return view('userview.userRegistration');
});

Route::get('/user-login', function () {
    return view('userview.userlogin');
});


//Route::get('/user-login', [AuthManager::class, 'login'])->name('login');
//Route::post('/user-login', [AuthManager::class, 'loginPost'])->name('login.post');
