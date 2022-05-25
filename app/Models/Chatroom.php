<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chatroom extends Model
{
    use HasFactory;

    const CANAL = 'canal';

    public function members(): HasMany
    {
        return $this->hasMany(ChatroomUser::class, 'group_id', 'id');
    }

    public function messages(): HasManyThrough
    {
        return $this->hasManyThrough(Message::class, ChatroomUser::class, 'group_id',  'group_member_id', 'id', 'id');
    }

    public function name(): HasOne
    {
        return $this->hasOne(ChatroomName::class, 'chatroom_id', 'id');
    }

    /**
     * Verify if a chatroom is a group
     *
     * @return bool
     */
    public function getIsGroupAttribute(): bool
    {
        return $this->members->count() > 1 && $this->type !=  self::CANAL;
    }

    /**
     * Verify is a chatroom is a canal
     *
     * @return bool
     */
    public function getIsCanalAttribute(): bool
    {
        return $this->type === self::CANAL;
    }

    /**
     * Verify is a chatroom is a unique conversation
     *
     * @return bool
     */
    public function getIsConversationAttribute(): bool
    {
        return $this->members->count() == 1 && $this->type != self::CANAL;
    }
}
