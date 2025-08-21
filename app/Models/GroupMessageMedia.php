<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class GroupMessageMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_message_id',
        'media_path',
        'media_type',
    ];

    protected $casts = [
        'group_message_id' => 'integer',
    ];

    public function groupMessage(): BelongsTo
    {
        return $this->belongsTo(GroupMessage::class);
    }
}
