<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Attributes that can be mass assigned
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Hidden attributes
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attributes to be cast
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
     * Obstacles created by this user.
     */
    public function createdObstacles(): HasMany
    {
        return $this->hasMany(Obstacle::class);
    }

    /**
     * Obstacles this user supported
     */
    public function supportedObstacles(): BelongsToMany
    {
        return $this->belongsToMany(Obstacle::class, 'obstacle_user')
                    ->withTimestamps();
    }

    /**
     * Comments created by this User
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Comments this user liked
     */
    public function likedComments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'comment_user')
                    ->withTimestamps();
    }
}