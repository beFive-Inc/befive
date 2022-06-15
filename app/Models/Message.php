<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Message extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

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
        $date = Carbon::parse($this->created_at);

        if (Carbon::now()->diffInYears($this->created_at) >= 1) {
            return Carbon::parse($this->created_at)
                ->diffForHumans();
        } elseif (Carbon::now()->diffInMonths($this->created_at) >= 1) {
            return Carbon::parse($this->created_at)
                ->diffForHumans();
        } elseif (Carbon::now()->diffInWeeks($this->created_at) >= 1) {
            return $date->format('j F');
        } elseif (Carbon::now()->diffInDays($this->created_at) >= 1) {
            return $date->format('l');
        } else {
            return $date->format('H:i');
        }
    }

    public function getDecryptedMessageAttribute()
    {
        return Crypt::decrypt($this->message);
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

    public function relatedMessage()
    {
        return $this->hasOne(Message::class, 'id', 'message_id');
    }
}
