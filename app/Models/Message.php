<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'text',
        'is_seen',
    ];


    protected $casts = [
        'sender_id' => 'integer',
        'receiver_id' => 'integer',
        'is_seen' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function medias()
    {
        return $this->hasMany(MessageMedia::class);
    }

    public function isSeen()
    {
        return $this->is_seen !== null;
    }

    public function getMessageSenderAvatarAttribute(){
        $user = User::find($this->sender_id);
        return $user->avatar;
    }

    public function latestMedia()
    {
        return $this->hasOne(MessageMedia::class)->latestOfMany();
    }

    public function hasMedia(){
        return $this->medias()->exists();
    }


}
