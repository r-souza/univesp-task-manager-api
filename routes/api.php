<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusController;
use App\Models\Status;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resources([
        'priorities' => \App\Http\Controllers\PriorityController::class,
        'projects' => \App\Http\Controllers\ProjectController::class,
        'status' => \App\Http\Controllers\StatusController::class,
    ]);

    /**
     * Restore routes
     */
    Route::post('/priorities/{id}/restore', [PriorityController::class, 'restore'])->name('priorities.restore');
    Route::post('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::post('/status/{id}/restore', [StatusController::class, 'restore'])->name('status.restore');

    /**
     * Trashed routes
     */
    Route::get('/priorities/{id}/trashed', [PriorityController::class, 'showTrashed'])->name('priorities.showTrashed');
    Route::get('/projects/{id}/trashed', [ProjectController::class, 'showTrashed'])->name('projects.showTrashed');
    Route::get('/status/{id}/trashed', [StatusController::class, 'showTrashed'])->name('status.showTrashed');
});
