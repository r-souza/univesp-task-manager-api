<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PriorityController;

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
    ]);

    /**
     * Restore routes
     */
    Route::post('/priorities/{id}/restore', [PriorityController::class, 'restore'])->name('priorities.restore');

    /**
     * Trashed routes
     */
    Route::get('/priorities/{id}/trashed', [PriorityController::class, 'showTrashed'])->name('priorities.showTrashed');
});
