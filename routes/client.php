<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientUserController;
use App\Http\Middleware\ClientUserMiddleware;

Route::middleware(['auth', ClientUserMiddleware::class])->group(function () {
    Route::prefix('my_projects')->group(function () {
        Route::get('/', [ClientUserController::class, 'clientOpenProjects'])->name('client.open.projects');
        Route::get('/in_progress', [ClientUserController::class, 'clientInProgressProjects'])->name('client.inProgress.projects');
        Route::get('/completed_projects', [ClientUserController::class, 'clientCompletedProjects'])->name('client.completed.projects');
        Route::get('/cancelled_projects', [ClientUserController::class, 'clientCancelledProjects'])->name('client.cancelled.projects');
    });
});
