<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StatusType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getSlugAttribute(): string
    {
        return Str::slug($this->name);
    }
}
