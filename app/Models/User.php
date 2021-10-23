<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Multicaret\Acquaintances\Traits\Friendable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Friendable;

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


    public function friends()
    {
        // All friends
        return $this->belongsToMany(User::class, "friendships", "sender_id", "recipient_id", 'id', 'id', User::class);
    }

    public function friendsFrom() :BelongsToMany
    {
        // Friends that I have invited
        return $this->belongsToMany(User::class, "friends", "user_id_from", "user_id_to", 'id', 'id', User::class)
            ->where("isAccepted", true);
    }

    public function friendsTo() : BelongsToMany
    {
        // Friends that invite me
        return $this->belongsToMany(User::class, "friends", "user_id_to", "user_id_from", 'id', 'id', User::class)
                ->where("isAccepted", true);
    }

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }
}
