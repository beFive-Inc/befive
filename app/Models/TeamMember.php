<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TeamMember
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereUserId($value)
 * @mixin \Eloquent
 */
class TeamMember extends Model
{
    use HasFactory;
}
