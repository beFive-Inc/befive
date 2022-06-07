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

    protected $fillable = [
        'name',
        'uuid',
        'type',
    ];

    /**
     * @return HasMany
     */
    public function authors(): HasMany
    {
        return $this->hasMany(ChatroomUser::class, 'chatroom_id', 'id')
            ->withTrashed();
    }

    /**
     * @return mixed
     */
    public function ownAuthor()
    {
        return $this->hasMany(ChatroomUser::class, 'chatroom_id', 'id')
            ->withTrashed()
            ->where('user_id', '=', auth()->id());
    }

    /**
     * @return mixed
     */
    public function otherAuthor()
    {
        return $this->hasMany(ChatroomUser::class, 'chatroom_id', 'id')
            ->withTrashed()
            ->where('user_id', '!=', auth()->id());
    }

    /**
     * @return HasManyThrough
     */
    public function messages(): HasManyThrough
    {
        return $this->hasManyThrough(Message::class, ChatroomUser::class, 'chatroom_id',  'chatroom_user_id', 'id', 'id')
            ->orderBy('created_at', 'DESC');
    }

    /**
     * @return HasManyThrough
     */
    public function onlyFiveLastMessages(): HasManyThrough
    {
        return $this->messages()->limit(1);
    }

    /**
     * Verify if a chatroom is a group
     *
     * @return bool
     */
    public function getIsGroupAttribute(): bool
    {
        return $this->authors->count() > 2 && $this->type !=  self::CANAL;
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
        return $this->authors->count() == 2 && $this->type != self::CANAL;
    }
}
