<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreelancerUserController;
use App\Http\Middleware\FreelancerUserMiddleware;

Route::middleware(['auth', FreelancerUserMiddleware::class])->group(function () {
    Route::get('/my_bids', [FreelancerUserController::class, 'freelancerBids'])->name('freelancer.bids');

    Route::get('/my_won_projects', [FreelancerUserController::class, 'freelancerWonProjects'])->name('freelancer.won.projects');
    Route::get('/my_won_projects/apply_select', [FreelancerUserController::class, 'applySelectOptionWonProjects'])->name('freelancer.apply.select');
});
