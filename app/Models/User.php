<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    // get the projects for the client user - relation to the projects table
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    // get all open projects for the user - relation to the projects table
    public function openProjects(): HasMany
    {
        return $this->projects()->where('status', 'open');
    }

    // get all in progress projects for the user - relation to the projects table
    public function inProgressProjects(): HasMany
    {
        return $this->projects()->where('status', 'in_progress');
    }

    // get all completed projects for the user - relation to the projects table
    public function completedProjects(): HasMany
    {
        return $this->projects()->where('status', 'completed');
    }

    // get all cancelled projects for the user - relation to the projects table
    public function cancelledProjects(): HasMany
    {
        return $this->projects()->where('status', 'cancelled');
    }

    // get all submitted bids by the freelancer user - relation to the bids table
    public function submittedBids(): HasMany
    {
        return $this->hasMany(Bid::class, 'freelancer_id');
    }

    // get client user conversations - relation to the conversations table
    public function clientConversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'client_id');
    }

    // get freelancer user conversations - relation to the conversations table
    public function freelancerConversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'freelancer_id');
    }

    // get user conversations - relation to the conversations table
    public function conversations(): Builder
    {
        return Conversation::where('client_id', $this->id)
            ->orWhere('freelancer_id', $this->id)
            ->withCount(['messages as unread_count' => function ($q) {
                    $q->where('sender_id', '!=', $this->id)
                        ->whereNull('read_at');
                }])
            ->with([
                'project:id,title,deadline,status',
                'client:id,name',
                'freelancer:id,name'
                ])
            ->latest();
    }
}
