<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/projects.php';
require __DIR__ . '/bids.php';
require __DIR__ . '/client.php';
require __DIR__ . '/freelancer.php';
require __DIR__ . '/conversations.php';
require __DIR__ . '/ratings.php';
require __DIR__ . '/settings.php';
