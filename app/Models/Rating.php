<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'client_id',
        'freelancer_id',
        'client_received_rate',
        'freelancer_received_rate'
    ];

    // get the project - relation to the projects table   
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // get ratings related to the client user - relation to the users table   
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // get ratings related to the freelancer user - relation to the users table   
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
