<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    return redirect('dashboard');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('files', FileController::class);

// Update User Status
Route::put('users/{user}/updateStatus', 'App\Http\Controllers\UserController@updateStatus')->name('users.updateStatus');

// User Management
Route::get('users/{user}/reset', 'App\Http\Controllers\UserController@resetPassword')->name('users.resetPassword');
Route::put('users/{user}/updatePassword', 'App\Http\Controllers\UserController@updatePassword')->name('users.updatePassword');
Route::resource('users', UserController::class);



