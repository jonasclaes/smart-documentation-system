<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisionAttachmentController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
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

Route::middleware([
    'auth'
])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Files
    Route::resource('files', FileController::class);

    // Revisions
    Route::get('files/{file}/revisions/copy', [RevisionController::class, 'copy'])->name('revisions.copy');
    Route::post('files/{file}/revisions/copy', [RevisionController::class, 'performCopy'])->name('revisions.performCopy');
    Route::resource('files/{file}/revisions', RevisionController::class);

    // Revision attachments
    Route::name('revisions.attachments')->group(function () {
        // Attachment create
        Route::post('files/{file}/revisions/{revision}/attachments', [RevisionAttachmentController::class, 'store'])->name('.store');
        Route::get('files/{file}/revisions/{revision}/attachments/create', [RevisionAttachmentController::class, 'create'])->name('.create');

        // Attachment show
        Route::get('files/{file}/revisions/{revision}/attachments/{document}', [RevisionAttachmentController::class, 'show'])->name('.show');

        // Attachment delete
        Route::delete('files/{file}/revisions/{revision}/attachments/{document}', [RevisionAttachmentController::class, 'destroy'])->name('.destroy');

        // Attachment download
        Route::get('files/{file}/revisions/{revision}/attachments/{document}/download', [RevisionAttachmentController::class, 'download'])->name('.download');
    });

    // Users
    Route::resource('users', UserController::class);
    Route::get('users/{user}/reset', 'App\Http\Controllers\UserController@resetPassword')->name('users.resetPassword');
    Route::put('users/{user}/updatePassword', 'App\Http\Controllers\UserController@updatePassword')->name('users.updatePassword');
    Route::put('users/{user}/updateStatus', 'App\Http\Controllers\UserController@updateStatus')->name('users.updateStatus');

    // Clients
    Route::resource('clients', ClientController::class);
});

// Localization
Route::get('localization/{locale}', LocalizationController::class);

// Public
Route::get('public/file/{file:uniqueId}', [PublicController::class, 'show'])->name('public.show');
