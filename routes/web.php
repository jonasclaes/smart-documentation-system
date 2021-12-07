<?php

use App\Http\Controllers\ClientContactController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisionAttachmentController;
use App\Http\Controllers\RevisionCommentController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserPermissionController;
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
        Route::get('files/{file}/revisions/{revision}/attachments/createDirectory', [RevisionAttachmentController::class, 'createDirectory'])->name('.createDirectory');

        // Attachment show
        Route::get('files/{file}/revisions/{revision}/attachments/{document}', [RevisionAttachmentController::class, 'show'])->name('.show');

        // Attachment delete
        Route::delete('files/{file}/revisions/{revision}/attachments/{document}', [RevisionAttachmentController::class, 'destroy'])->name('.destroy');

        // Attachment download
        Route::get('files/{file}/revisions/{revision}/attachments/{document}/download', [RevisionAttachmentController::class, 'download'])->name('.download');
    });

    // Revision Comments
    Route::name('revisions.comments')->group(function () {
        // Comment Create
        Route::post('files/{file}/revisions/{revision}/comments', [RevisionCommentController::class, 'store'])->name('.store');
        Route::get('files/{file}/revisions/{revision}/comments/create', [RevisionCommentController::class, 'create'])->name('.create');

        // Comment Edit
        Route::get('files/{file}/revisions/{revision}/comments/{comment}/edit', [RevisionCommentController::class, 'edit'])->name('.edit');
        Route::post('files/{file}/revisions/{revision}/comments/{comment}/update', [RevisionCommentController::class, 'update'])->name('.update');

        // Comment show
        Route::get('files/{file}/revisions/{revision}/comments/{comment}', [RevisionCommentController::class, 'show'])-> name('.show');

        // Comment delete
        Route::delete('files/{file}/revisions/{revision}/comments/{comment}', [RevisionCommentController::class, 'destroy'])->name('.destroy');
    });

    // Users
    Route::resource('users', UserController::class);
    Route::get('users/{user}/reset', 'App\Http\Controllers\UserController@resetPassword')->name('users.resetPassword');
    Route::put('users/{user}/updatePassword', 'App\Http\Controllers\UserController@updatePassword')->name('users.updatePassword');
    Route::put('users/{user}/updateStatus', 'App\Http\Controllers\UserController@updateStatus')->name('users.updateStatus');

    // User permissions
    Route::resource('userPermissions', UserPermissionController::class);

    // Clients
    Route::resource('clients', ClientController::class);

    // Client contacts
    Route::resource('clients/{client}/clientContacts', ClientContactController::class);
});

// Localization
Route::get('localization/{locale}', LocalizationController::class);

// Public
Route::prefix('public/')->name('public.')->group(function () {
    Route::get('theme/update', [PublicController::class, 'updateTheme'])->name('theme.update');
    Route::get('files/{file}/verify', [PublicController::class, 'showFileVerifier'])->name('showFileVerifier');
    Route::get('files/{file}', [PublicController::class, 'showFile'])->name('showFile');
    Route::get('files/{file}/revisions/{revision}', [PublicController::class, 'showRevision'])->name('showRevision');

    Route::get('files/{file}/revisionRequests/create', [PublicController::class, 'createRevisionRequest'])->name('createRevisionRequest');
    Route::post('files/{file}/revisionRequests', [PublicController::class, 'storeRevisionRequest'])->name('storeRevisionRequest');

    Route::get('files/{file}/revisionRequests/{revisionRequest}/edit', [PublicController::class, 'editRevisionRequest'])->name('editRevisionRequest');
    Route::put('files/{file}/revisionRequests/{revisionRequest}', [PublicController::class, 'updateRevisionRequest'])->name('updateRevisionRequest');

    Route::get('files/{file}/revisionRequests/{revisionRequest}', [PublicController::class, 'showRevisionRequest'])->name('showRevisionRequest');
    Route::get('files/{file}/revisions/{revision}/attachments/{document}/download', [PublicController::class, 'downloadDocument'])->name('downloadDocument');

    Route::get('files/{file}/shareFile', [PublicController::class, 'shareFile'])->name('shareFile');
    Route::post('files/{file}/shareFile', [PublicController::class, 'doShareFile'])->name('doShareFile');
});
