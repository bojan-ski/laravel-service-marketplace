<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    protected static function boot()
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

    // public function bids(){
    //     return $this->hasMany(Bid::class);
    // }
}
