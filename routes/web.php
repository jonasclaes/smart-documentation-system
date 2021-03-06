<?php

use App\Http\Controllers\ClientContactController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisionAttachmentController;
use App\Http\Controllers\RevisionCommentController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\RevisionRequestCommentController;
use App\Http\Controllers\RevisionRequestController;
use App\Http\Controllers\RevisionRequestDocumentController;
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

    // Log route
    Route::get('/logs', [LogController::class, 'index'])->name('logs');

    // Files
    Route::resource('files', FileController::class);

    // Revision requests
    Route::post('files/{file}/revisionRequests/{revisionRequest}/approve', [RevisionRequestController::class, 'approve'])->name('revisionRequests.approve');
    Route::post('files/{file}/revisionRequests/{revisionRequest}/refuse', [RevisionRequestController::class, 'refuse'])->name('revisionRequests.refuse');
    Route::get('files/{file}/revisionRequests/{revisionRequest}/reopen', [RevisionRequestController::class, 'reopen'])->name('revisionRequests.reopen');
    Route::post('files/{file}/revisionRequests/{revisionRequest}/reopen', [RevisionRequestController::class, 'doReopen'])->name('revisionRequests.doReopen');
    Route::resource('files/{file}/revisionRequests', RevisionRequestController::class);

    // Revision request documents
    Route::get('files/{file}/revisionRequests/{revisionRequest}/documents/{revisionRequestDocument}/download', [RevisionRequestDocumentController::class, 'download'])->name('revisionRequestDocuments.download');
    Route::resource('files/{file}/revisionRequests/{revisionRequest}/revisionRequestDocuments', RevisionRequestDocumentController::class);

    // Revision request comments
    Route::resource('files/{file}/revisionRequests/{revisionRequest}/revisionRequestComments', RevisionRequestCommentController::class);

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
    Route::put('users/{user}/updateStatus', 'App\Http\Controllers\UserController@updateStatus')->name('users.updateStatus');

    // User permissions
    Route::resource('userPermissions', UserPermissionController::class);
    Route::get('users/{user}/permissions', [UserPermissionController::class, 'edit'])->name('userPermissions.edit');
    Route::put('users/{user}/updatePermissions', [UserPermissionController::class, 'update'])->name('userPermissions.update');

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

    Route::get('files/{file}/revisionRequests/create', [PublicController::class, 'createRevisionRequest'])->name('revisionRequests.create');
    Route::post('files/{file}/revisionRequests', [PublicController::class, 'storeRevisionRequest'])->name('revisionRequests.store');

    Route::get('files/{file}/revisionRequests/{revisionRequest}/edit', [PublicController::class, 'editRevisionRequest'])->name('revisionRequests.edit');
    Route::put('files/{file}/revisionRequests/{revisionRequest}/submit', [PublicController::class, 'submitRevisionRequest'])->name('revisionRequests.submit');
    Route::put('files/{file}/revisionRequests/{revisionRequest}', [PublicController::class, 'updateRevisionRequest'])->name('revisionRequests.update');

    // Revision request attachments
    Route::get('files/{file}/revisionRequests/{revisionRequest}/attachments/upload', [PublicController::class, 'addRevisionRequestAttachment'])->name('revisionRequests.attachments.create');
    Route::post('files/{file}/revisionRequests/{revisionRequest}/attachments', [PublicController::class, 'storeRevisionRequestAttachment'])->name('revisionRequests.attachments.store');
    Route::delete('files/{file}/revisionRequests/{revisionRequest}/attachments/{revisionRequestDocument}', [PublicController::class, 'destroyRevisionRequestAttachment'])->name('revisionRequests.attachments.delete');

    // Revision request comments
    Route::get('files/{file}/revisionRequests/{revisionRequest}/comments/create', [PublicController::class, 'addRevisionRequestComment'])->name('revisionRequests.comments.create');
    Route::post('files/{file}/revisionRequests/{revisionRequest}/comments', [PublicController::class, 'storeRevisionRequestComment'])->name('revisionRequests.comments.store');
    Route::delete('files/{file}/revisionRequests/{revisionRequest}/comments/{revisionRequestComment}', [PublicController::class, 'destroyRevisionRequestComment'])->name('revisionRequests.comments.delete');

    Route::get('files/{file}/revisionRequests/{revisionRequest}', [PublicController::class, 'showRevisionRequest'])->name('revisionRequests.show');
    Route::get('files/{file}/revisions/{revision}/attachments/{document}/download', [PublicController::class, 'downloadDocument'])->name('revisionRequests.download');

    Route::get('files/{file}/shareFile', [PublicController::class, 'shareFile'])->name('revisionRequests.shareFile');
    Route::post('files/{file}/shareFile', [PublicController::class, 'doShareFile'])->name('revisionRequests.performShareFile');
});
