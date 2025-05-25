<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;

Route::middleware('auth')->group(function () {
    Route::post('/{project}/bid_for_project', [BidController::class, 'store'])->name('freelancer.bid.store');
    Route::delete('/{bid}/destroy', [BidController::class, 'destroy'])->name('freelancer.bid.destroy');
});