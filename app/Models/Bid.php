<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    use HasFactory;

    protected $table = 'bids';
    protected $fillable = [
        'project_id',
        'freelancer_id',
        'budget_type',
        'bid_amount',
        'estimated_days',
        'bid_message',
        'status',
    ];

    // get the project related to the bid - relation to the projects table
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // get the freelance user who submitted the bid - relation to the users table
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    // accept the bid - relation to the bids table
    public function acceptBid(): void
    {
        $this->update(['status' => 'accepted']);

        $this->project->bids()
            ->where('id', '!=', $this->id)
            ->where('status', '==', 'pending')
            ->update(['status' => 'rejected']);
    }

    // reject the bid - relation to the bids table
    public function rejectBid(): void
    {
        $this->update(['status' => 'rejected']);
    }
}
