<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientUserController;
use App\Http\Middleware\ClientUserMiddleware;

Route::middleware('auth')->group(function () {
    Route::middleware(ClientUserMiddleware::class)->group(function () {
        Route::get('/my_open_projects', [ClientUserController::class, 'clientOpenProjects'])->name('client.open.projects');
        Route::get('/my_in_progress_projects', [ClientUserController::class, 'clientInProgressProjects'])->name('client.inProgress.projects');
        Route::get('/my_completed_projects', [ClientUserController::class, 'clientCompletedProjects'])->name('client.completed.projects');
        Route::get('/my_cancelled_projects', [ClientUserController::class, 'clientCancelledProjects'])->name('client.cancelled.projects');
    });
});
