<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'user1_id',
        'user2_id',
        'status',
    ];

    protected $casts = [
        'user1_id' => 'integer',
        'user2_id' => 'integer',
    ];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function getUser1DisplayNameAttribute()
    {
        return $this->user1 ? $this->user1->display_name : 'Unknown User';
    }

    public function getUser2DisplayNameAttribute()
    {
        return $this->user2 ? $this->user2->display_name : 'Unknown User';
    }

    public function getUser1AvatarAttribute()
    {
        return $this->user1 ? $this->user1->avatar : 'default_user_avatar.png';
    }

    public function getUser2AvatarAttribute()
    {
        return $this->user2 ? $this->user2->avatar : 'default_user_avatar.png';
    }

}
