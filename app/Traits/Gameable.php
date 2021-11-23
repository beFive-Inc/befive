<?php

namespace App\Traits;

use App\Models\GameLinked;
use App\Models\Post;
use Illuminate\Support\Str;

trait Gameable
{
    public function addGame($game) {
        $newGame = (new GameLinked())->fill([
            'game_id' => $game->id,
        ]);

        $this->games()
            ->save($newGame);

        return $newGame;
    }
}
