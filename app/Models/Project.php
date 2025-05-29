<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $guarded = [
        'user_id'
    ];
    protected $fillable = [
        'title',
        'description',
        'requirements',
        'budget_type',
        'budget_amount',
        'hour_price',
        'deadline',
        'document_path',
        'status',
    ];

    // add user_id automatically to all new projects when posting a new project
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

    // get client user projects - relation to the user table
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // get the bids for the project - relation to the bids table
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    // get the won/accepted bid - relation to the bid table
    public function acceptedBid(): HasOne
    {
        return $this->hasOne(Bid::class)->where('status', 'accepted');
    }

    // get the conversation - relation to the conversations table
    public function conversation(): HasOne
    {
        return $this->hasOne(Conversation::class)
            ->whereColumn('client_id', 'projects.user_id')
            ->whereHas('freelancer', function ($q) {
                $q->whereColumn('freelancer.id', 'projects.accepted.freelancer_id');
            });
    }
}
