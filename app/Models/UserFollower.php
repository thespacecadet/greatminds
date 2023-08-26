<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserFollower extends Pivot
{
    protected $fillable = [
        'user_id',
        'follower_id',
    ];


    use HasFactory;
}
