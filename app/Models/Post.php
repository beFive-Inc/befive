<?php

namespace App\Models;

use App\Traits\Gameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $creator_type
 * @property int $creator_id
 * @property string|null $body
 * @property string $uuid
 * @property string $status public/private/friends
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GameLinked[] $games
 * @property-read int|null $games_count
 * @property-read mixed $is_friends
 * @property-read mixed $is_private
 * @property-read mixed $is_public
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreator($model)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Post withoutTrashed()
 * @mixin \Eloquent
 */
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
