<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Middleware\AdminUserMiddleware;

Route::middleware(['auth', AdminUserMiddleware::class])->group(function () {
    Route::get('/client_users', [AdminUserController::class, 'allClientUsers'])->name('admin.clients');
    Route::get('/client_users/{client}', [AdminUserController::class, 'clientUser'])->name('admin.client');
});
