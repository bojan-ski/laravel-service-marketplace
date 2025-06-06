<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminUserMiddleware;


Route::middleware(['auth', AdminUserMiddleware::class])->group(function () {    

});