<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Middleware\ClientUserMiddleware;

Route::middleware('auth')->group(function () {
    Route::post('/{project}/bid_for_project', [BidController::class, 'store'])->name('freelancer.bid.store');
    Route::delete('/{bid}/destroy', [BidController::class, 'destroy'])->name('freelancer.bid.destroy');

    Route::middleware(ClientUserMiddleware::class)->group(function () {
        Route::prefix('projects')->group(function () {
            Route::put('{project}/{bid}/accept', [BidController::class, 'accept'])->name('client.bid.accept');
            Route::put('{project}/{bid}/reject', [BidController::class, 'reject'])->name('client.bid.reject');
        });
    });
});
