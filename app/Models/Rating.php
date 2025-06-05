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
}
