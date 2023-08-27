<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Followers of the user.
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_follower','user_id','follower_id')
            ->using(UserFollower::class)
            ->withTimestamps();
    }

    /**
     * Followed by the user.
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_follower','follower_id','user_id')
            ->using(UserFollower::class)
            ->select(['users.id','name'])
            ->withTimestamps();
    }

    /**
     * Check if user is followed by specific user
     */
    public function isFollowedBy($follower, $user = null): bool
    {
        if (!$user) {
            $user = $this->id;
        }
        return DB::table('user_follower')
            ->where([['user_id', $user],['follower_id',$follower]])
            ->exists();
    }

    /**
     * Check if user is following a specific user
     */
    public function isFollowing($followedUser, $user = null): bool
    {
        if (!$user) {
            $user = $this->id;
        }
        return DB::table('user_follower')
            ->where([['user_id', $followedUser],['follower_id',$user]])
            ->exists();
    }

}
