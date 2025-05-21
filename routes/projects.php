<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;

Route::middleware('auth')->group(function () {
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectsController::class, 'index'])->name('projects.index');
        Route::get('/create', [ProjectsController::class, 'create'])->name('projects.create');
        Route::post('/store', [ProjectsController::class, 'store'])->name('projects.store');
        Route::get('/{project}', [ProjectsController::class, 'show'])->name('projects.show');
    });
});