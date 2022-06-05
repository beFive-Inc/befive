<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chatroom_user_id',
        'message_id',
        'message'
    ];

    /**
     * @return string
     */
    public function getDateAttribute(): string
    {
        return Carbon::parse($this->created_at)
            ->diffForHumans();
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(ChatroomUser::class, 'chatroom_user_id', 'id');
    }


    public function chatroom()
    {
        return $this->author()->with('chatroom');
    }
}
