<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreelancerUserController;

Route::middleware('auth')->group(function () {    
    Route::get('/my_bids', [FreelancerUserController::class, 'freelancerBids'])->name('freelancer.bids');
});
