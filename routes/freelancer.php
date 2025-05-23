<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreelancerUserController;

Route::middleware('auth')->group(function () {
    Route::get('/bided_projects', [FreelancerUserController::class, 'freelancerBidedProjects'])->name('freelancer.bided.projects');
});
