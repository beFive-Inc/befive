<?php

namespace App\Models;

use App\Traits\Gameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use Gameable;

    const PUBLIC = 'public';
    const PRIVATE = 'private';
    const FRIENDS = 'friends';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = ['creator_type', 'creator_id', 'body', 'status', 'uuid'];


    public function creator()
    {
        return $this->morphTo('creator');
    }

    public function games()
    {
        return $this->morphMany(GameLinked::class, 'linked');
    }

    public function fillCreator($creator)
    {
        return $this->fill([
            'creator_id' => $creator->getKey(),
            'creator_type' => $creator->getMorphClass()
        ]);
    }

    public function getIsPublicAttribute()
    {
        return $this->status === self::PUBLIC;
    }

    public function getIsPrivateAttribute()
    {
        return $this->status === self::PRIVATE;
    }

    public function getIsFriendsAttribute()
    {
        return $this->status === self::FRIENDS;
    }

    public function scopeWhereCreator($query, $model)
    {
        return $query->where('creator_id', $model->getKey())
            ->where('creator_type', $model->getMorphClass());
    }
}
