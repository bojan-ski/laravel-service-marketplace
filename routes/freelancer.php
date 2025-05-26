<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreelancerUserController;
use App\Http\Middleware\FreelancerUserMiddleware;

Route::middleware(['auth', FreelancerUserMiddleware::class])->group(function () {
    Route::get('/my_bids', [FreelancerUserController::class, 'freelancerBids'])->name('freelancer.bids');
});
