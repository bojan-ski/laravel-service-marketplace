<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SearchController;

Route::middleware('auth')->group(function () {
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectsController::class, 'index'])->name('projects.index');
        Route::get('/search', [SearchController::class, 'search'])->name('projects.search');
        Route::get('/create', [ProjectsController::class, 'create'])->name('projects.create');
        Route::post('/store', [ProjectsController::class, 'store'])->name('projects.store');
        Route::get('/{project}/edit', [ProjectsController::class, 'edit'])->name('projects.edit');
        Route::put('/{project}/update', [ProjectsController::class, 'update'])->name('projects.update');
        Route::delete('/{project}/destroy', [ProjectsController::class, 'destroy'])->name('projects.destroy');
        Route::get('/{project}', [ProjectsController::class, 'show'])->name('projects.show');
    });
});