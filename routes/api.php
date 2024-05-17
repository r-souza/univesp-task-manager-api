<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;

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

Route::prefix('auth')->group(function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
        Route::get('refresh', [\App\Http\Controllers\AuthController::class, 'refresh'])->name('auth.refresh');
    });

    Route::get('/me', [\App\Http\Controllers\AuthController::class, 'me'])->name('auth.me');

    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::resources([
        'priorities' => \App\Http\Controllers\PriorityController::class,
        'projects' => \App\Http\Controllers\ProjectController::class,
        'status' => \App\Http\Controllers\StatusController::class,
        'tasks' => \App\Http\Controllers\TaskController::class,
    ]);

    /**
     * Restore routes
     */
    Route::post('/priorities/{id}/restore', [PriorityController::class, 'restore'])->name('priorities.restore');
    Route::post('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::post('/status/{id}/restore', [StatusController::class, 'restore'])->name('status.restore');
    Route::post('/tasks/{id}/restore', [TaskController::class, 'restore'])->name('tasks.restore');

    /**
     * Trashed routes
     */
    Route::get('/priorities/{id}/trashed', [PriorityController::class, 'showTrashed'])->name('priorities.showTrashed');
    Route::get('/projects/{id}/trashed', [ProjectController::class, 'showTrashed'])->name('projects.showTrashed');
    Route::get('/status/{id}/trashed', [StatusController::class, 'showTrashed'])->name('status.showTrashed');
    Route::get('/tasks/{id}/trashed', [TaskController::class, 'showTrashed'])->name('tasks.showTrashed');
});
