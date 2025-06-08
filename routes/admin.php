<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Middleware\AdminUserMiddleware;

Route::middleware(['auth', AdminUserMiddleware::class])->group(function () {
    Route::get('/client_users', [AdminUserController::class, 'allClientUsers'])->name('admin.clients');
    Route::get('/client_users/{client}', [AdminUserController::class, 'clientUser'])->name('admin.client');

    Route::get('/freelancer_users', [AdminUserController::class, 'allFreelancerUsers'])->name('admin.freelancers');
    Route::get('/freelancer_users/{freelancer}', [AdminUserController::class, 'freelancerUser'])->name('admin.freelancer');

    Route::get('/all_projects', [AdminUserController::class, 'allProjects'])->name('admin.projects');
    Route::get('/all_projects/apply_select', [AdminUserController::class, 'filterProjects'])->name('admin.projects.filter');
});
