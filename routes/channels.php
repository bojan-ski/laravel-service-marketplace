<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{chatHash}', function ($user, $chatHash) {
    $conversation = Conversation::where('chat_hash', $chatHash)->first();

    if (!$conversation) return false;

    return ($user->id == $conversation->client_id || $user->id == $conversation->freelancer_id || $user->account_type == 'admin');
});
