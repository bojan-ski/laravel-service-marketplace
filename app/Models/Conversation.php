<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable =[
        'chat_hash',
        'project_id',
        'client_id',
        'freelancer_id',
    ];

    // add chat_hash automatically to all new conversations when new conversation is created/started
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->chat_hash = Str::uuid();
        });
    }

    // get the project - relation to the projects table   
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // get the client user - relation to the users table 
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // get the freelancer user - relation to the users table
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    // get the messages - relation to the messages table
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'chat_hash', 'chat_hash');
    }
}
