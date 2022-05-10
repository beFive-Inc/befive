<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GameLinked
 *
 * @property int $id
 * @property int $game_id
 * @property string $linked_type
 * @property int $linked_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $linked
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked query()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked whereLinkedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked whereLinkedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLinked whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GameLinked extends Model
{
    use HasFactory;

    protected $table = 'game_linked';

    public function linked()
    {
        return $this->morphTo('linked');
    }
}
