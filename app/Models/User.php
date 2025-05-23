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

    // Get the projects for the client user - relation to the projects table
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    // Get all open projects for the user - relation to the projects table
    public function openProjects(): Builder
    {
        return $this->projects()->where('status', 'open');
    }

    // Get all in progress projects for the user - relation to the projects table
    public function inProgressProjects(): Builder
    {
        return $this->projects()->where('status', 'in_progress');
    }

    // Get all completed projects for the user - relation to the projects table
    public function completedProjects(): Builder
    {
        return $this->projects()->where('status', 'completed');
    }

    // Get all cancelled projects for the user - relation to the projects table
    public function cancelledProjects(): Builder
    {
        return $this->projects()->where('status', 'cancelled');
    }
}
