<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatroomUser extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(Chatroom::class, 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'group_member_id', 'id');
    }
}
