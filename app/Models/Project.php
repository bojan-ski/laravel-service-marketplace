<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [
        'user_id'
    ];
    protected $table = 'projects';
    protected $fillable = [
        'user_id',
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function bids(){
    //     return $this->hasMany(Bid::class);
    // }
}
