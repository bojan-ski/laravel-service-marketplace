<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\IsProjectOwnerMiddleware;

Route::middleware('auth')->group(function () {
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/search', [SearchController::class, 'search'])->name('projects.search');
        Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');

        Route::put('/{project}/rate', [RatingController::class, 'rateUser'])
            ->name('ratings.rateUser');
            
        Route::middleware(IsProjectOwnerMiddleware::class)->group(function () {
            Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
            Route::put('/{project}/update', [ProjectController::class, 'update'])->name('projects.update');
            Route::delete('/{project}/destroy', [ProjectController::class, 'destroy'])->name('projects.destroy');
            Route::put('/{project}/{status}', [ProjectController::class, 'statusChange'])->name('projects.statusChange');
        });

        Route::get('/{project}', [ProjectController::class, 'show'])->name('projects.show');
    });
});
