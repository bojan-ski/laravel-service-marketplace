<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;

Route::middleware('auth')->group(function () {
    Route::prefix('projects')->group(function () {
        Route::get('/create', [ProjectsController::class, 'create'])->name('projects.create');
    });
});