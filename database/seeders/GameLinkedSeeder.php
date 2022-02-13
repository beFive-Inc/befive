<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Team;
use App\Models\User;

use Illuminate\Database\Seeder;

class GameLinkedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = Game::all();
        $users = User::all();
        $teams = Team::all();

        foreach ($users as $user) {
            $user->addGame($games->shuffle()->first());
            $user->addGame($games->shuffle()->first());
            $user->addGame($games->shuffle()->first());
        }

        foreach ($teams as $team) {
            $team->addGame($games->shuffle()->first());
            $team->addGame($games->shuffle()->first());
            $team->addGame($games->shuffle()->first());
        }
    }
}
