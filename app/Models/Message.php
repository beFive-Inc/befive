<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_member_id',
        'message_id',
        'message',
        'type'
    ];

    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)
            ->diffForHumans();
    }

    public function member()
    {
        return $this->belongsTo(ChatroomUser::class, 'group_member_id', 'id');
    }

    public function group()
    {
        return $this->hasOneThrough(Chatroom::class, ChatroomUser::class, 'group_id', 'id', 'group_member_id', 'id');
    }
}
