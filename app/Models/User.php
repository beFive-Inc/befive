<?php

namespace App\Models;

use App\Traits\Gameable;
use App\Traits\Messageable;
use App\Traits\Postable;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Multicaret\Acquaintances\Traits\CanBeFollowed;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use Multicaret\Acquaintances\Traits\CanBeRated;
use Multicaret\Acquaintances\Traits\CanFollow;
use Multicaret\Acquaintances\Traits\CanLike;
use Multicaret\Acquaintances\Traits\CanRate;
use Multicaret\Acquaintances\Traits\Friendable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable;
    Use Postable;
    use Messageable;
    use InteractsWithMedia;
    use \App\Traits\Friendable;
    use Friendable;
    use Gameable;
    use CanFollow, CanBeFollowed;
    use CanLike, CanBeLiked;
    use CanRate, CanBeRated;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pseudo',
        'slug',
        'hashtag',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'email',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool
     */
    public function isOnline(): bool
    {
        return $this->sessions->last()->last_activity > Carbon::now();
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function getOnlineStatusAttribute()
    {
        if ($this->sessions->last()->last_activity > Carbon::now()) {
            return __('Actif');
        } else {
            return __('friends.offline.status', [
                'time' => Carbon::now()->diffForHumans(
                    $this->sessions->last()->last_activity,
            true,
                ),
            ]);
        }
    }

    /**
     * @return HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    /**
     * @return BelongsToMany
     */
    public function chatrooms(): BelongsToMany
    {
        return $this->belongsToMany(Chatroom::class, ChatroomUser::class, 'user_id', 'chatroom_id', 'id', 'id');
    }

    /**
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(Status::class);
    }

    public function type()
    {
        return $this->hasOneThrough(StatusType::class, Status::class, 'user_id', 'id', 'id', 'type_id');
    }

}
