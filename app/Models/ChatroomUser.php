<?php

namespace App\Models;

use App\Traits\Messageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatroomUser extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Messageable;

    protected $table = 'chatroom_users';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $visible = [
        'deleted_at',
    ];

    protected $fillable = [
        'chatroom_id',
        'user_id',
        'name',
        'status',
        'view_at'
    ];

    /**
     * @return bool
     */
    public function isViewed(): bool
    {
        return $this->chatroom->lastMessage->first()->created_at >= $this->view_at;
    }

    /**
     * @return BelongsTo
     */
    public function chatroom(): BelongsTo
    {
        return $this->belongsTo(Chatroom::class, 'chatroom_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
            ->with('media');
    }

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'chatroom_user_id', 'id')
            ->orderBy('created_at', 'DESC');
    }
}
