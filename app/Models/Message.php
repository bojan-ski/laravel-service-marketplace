<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable =[
        'chat_hash',
        'sender_id',
        'message',
        'read_at',
    ];

    // get the conversation - relation to the conversations table
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class, 'chat_hash', 'chat_hash');
    }

    // get the user who sent the message - relation to the users table
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
