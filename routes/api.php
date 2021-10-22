<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

// Create API token route.
Route::post('/token/create', [App\Http\Controllers\TokenController::class, 'createToken'])->name('token_create');

Route::apiResources([
    'client' => App\Http\Controllers\Api\ClientController::class,
    'file' => App\Http\Controllers\Api\FileController::class,
    'revision' => App\Http\Controllers\Api\RevisionController::class,
    'revisionRequest' => App\Http\Controllers\Api\RevisionRequestController::class,
    'document' => App\Http\Controllers\Api\DocumentController::class,
    'comment' => App\Http\Controllers\Api\CommentController::class,
    'revisionRequestDocument' => App\Http\Controllers\Api\RevisionRequestDocumentController::class,
    'revisionRequestComment' => App\Http\Controllers\Api\RevisionRequestCommentController::class,
    'revisionRequestCategory' => App\Http\Controllers\Api\RevisionRequestCategoryController::class,
    'QRCode' => App\Http\Controllers\Api\QRCodeController::class,
    'user' => App\Http\Controllers\Api\UserController::class
]);