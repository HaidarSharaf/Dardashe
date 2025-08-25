<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Message;
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
        'display_name',
        'avatar',
        'email',
        'password',
        'otp_code',
        'otp_expires_at',
        'otp_sent_at',
    ];

    public function getRouteKeyName(){
        return 'display_name';
    }

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
            'otp_expires_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_code' => 'hashed'
        ];
    }


    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new PasswordReset($token));
    }


    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function groupMessages()
    {
        return $this->hasMany(GroupMessage::class, 'user_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_members');
    }

    public function friendships()
    {
        return $this->hasMany(Friendship::class);
    }

    public function friends()
    {
        return Friendship::where('user1_id', $this->id)
            ->orWhere('user2_id', $this->id);
    }

    public function friendsList()
    {
        $friendships = $this->friends()->where('status', 'accepted')->get();

        return $friendships->map(function ($friendship) {
            return $friendship->user1_id === $this->id ? $friendship->user2 : $friendship->user1;
        });
    }

    public function latestMessage(User $user)
    {
        return Message::where(function ($query) use ($user) {
            $query->where('sender_id', $this->id)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $this->id);
        })->latest()->first();
    }

    public function unseenMessagesCount(User $user)
    {
        return Message::where('sender_id', $user->id)
            ->where('receiver_id', $this->id)
            ->where('is_seen', null)
            ->count();
    }
}
