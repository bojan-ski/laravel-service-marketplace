<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;

Route::middleware('auth')->group(function () {
    Route::prefix('ratings')->group(function () {
        Route::get('/', [RatingController::class, 'index'])->name('ratings.index');
        Route::put('/{project}/rate_user', [RatingController::class, 'rateUser'])
            ->name('ratings.rateUser');
    });
});
