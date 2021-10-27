<?php

namespace App\Models;

use App\Traits\Postable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    use Postable;

    public function posts()
    {
        return $this->morphMany(Post::class, 'creator');
    }
}
