<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class MessageMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'media_path',
        'media_type',
    ];

    protected $casts = [
        'message_id' => 'integer',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function isImage()
    {
        return $this->media_type === 'image';
    }

    public function isVideo()
    {
        return $this->media_type === 'video';
    }

    public function isAudio()
    {
        return $this->media_type === 'audio';
    }

    public function isFile()
    {
        return $this->media_type === 'file';
    }
}
