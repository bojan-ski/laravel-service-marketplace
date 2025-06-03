<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Middleware\IsConversationParticipantMiddleware;
use App\Http\Middleware\IsMessageOwnerMiddleware;

Route::middleware('auth')->group(function () {
    Route::get('/projects/{project}/message', [ConversationController::class, 'thread'])
        ->name('conversations.thread');

    Route::prefix('conversations')->group(function () {
        Route::get('/', [ConversationController::class, 'index'])->name('conversations.index');

        Route::middleware(IsConversationParticipantMiddleware::class)->group(function () {
            Route::get('/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
            Route::post('/{conversation}/store', [MessageController::class, 'store'])->name('messages.store');
        });

        Route::delete('/messages/{message}/destroy', [MessageController::class, 'destroy'])
            ->middleware(IsMessageOwnerMiddleware::class)
            ->name('messages.destroy');
    });
});
