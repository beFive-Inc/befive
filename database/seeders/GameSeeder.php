<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $accessTokenCacheKey = 'igdb_cache.access_token';

        $accessToken = Cache::put($accessTokenCacheKey, env('TWITCH_TOKEN'));

        for ($i = 1; $i < 4000000; $i++) {
            $game = \MarcReichel\IGDBLaravel\Models\Game::find($i);
            if (isset($game)) {
                Game::create([
                    'igbd_id' => $game->id,
                    'name' => $game->name,
                    'slug' => \Str::slug($game->name),
                    'summary' => $game->summary,
                    'first_released_at' => $game->first_release_date
                ]);
            }
        }
        */
    }
}
