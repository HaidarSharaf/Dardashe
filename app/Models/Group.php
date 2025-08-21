<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar'
    ];
    public function members()
    {
        return $this->hasMany(User::class, 'group_members');
    }

    public function messages()
    {
        return $this->hasMany(GroupMessage::class);
    }
}
