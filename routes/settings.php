<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\AppearanceController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('settings.profile.destroy');

    Route::get('settings/password', [PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [PasswordController::class, 'update'])->name('settings.password.update');
    
    Route::get('settings/appearance', [AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});