<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatroomName extends Model
{
    use HasFactory;

    public function chatroom(): BelongsTo
    {
        return $this->belongsTo(Chatroom::class, 'chatroom_id', 'id');
    }
}
