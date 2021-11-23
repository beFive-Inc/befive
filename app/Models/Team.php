<?php

namespace App\Models;

use App\Traits\Gameable;
use App\Traits\Postable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Team extends Model implements HasMedia
{
    use HasFactory;
    use Postable;
    use Gameable;
    use InteractsWithMedia;

    public function posts()
    {
        return $this->morphMany(Post::class, 'creator');
    }

    public function games()
    {
        return $this->morphMany(GameLinked::class, 'linked');
    }
}
