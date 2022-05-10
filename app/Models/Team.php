<?php

namespace App\Models;

use App\Traits\Gameable;
use App\Traits\Postable;;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property int $admin_id
 * @property string $name
 * @property string $slug
 * @property string|null $site_url
 * @property string|null $site_name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GameLinked[] $games
 * @property-read int|null $games_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Database\Factories\TeamFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereSiteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereSiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Team extends Model implements HasMedia
{
    use HasFactory;
    use Postable;
    use Gameable;
    use InteractsWithMedia;

    protected $fillable = [
        'admin_id',
        'name',
        'slug',
        'site_url',
        'site_name',
        'description'
    ];

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'admin_id');
    }

    public function posts()
    {
        return $this->morphMany(Post::class, 'creator');
    }

    public function games()
    {
        return $this->morphMany(GameLinked::class, 'linked');
    }
}
