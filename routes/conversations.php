<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Middleware\ClientUserMiddleware;
use App\Http\Middleware\IsConversationParticipantMiddleware;
use App\Http\Middleware\IsMessageOwnerMiddleware;

Route::middleware('auth')->group(function () {
    Route::middleware(IsConversationParticipantMiddleware::class)->group(function () {
        Route::prefix('conversations')->group(function () {
            Route::get('/', [ConversationController::class, 'index'])->name('conversations.index');
            Route::get('/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
            Route::post('/{conversation}/store', [MessageController::class, 'store'])->name('messages.store');

            Route::delete('/messages/{message}/destroy', [MessageController::class, 'destroy'])
                ->middleware(IsMessageOwnerMiddleware::class)
                ->name('messages.destroy');
        });
    });

    Route::get('/projects/{project}/message/{freelancerId}', [ConversationController::class, 'thread'])
        ->middleware(ClientUserMiddleware::class)
        ->name('conversations.thread');
});
