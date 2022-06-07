<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusType;
use App\Models\User;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $status = collect([
            'Je suis là',
            'En pleine partie',
            'Venez parler',
            'Je joue',
            "M'ennuyez pas",
            'J\'aime tout le monde',
            'Qui fais quoi ?',
            'Yo tout le monde',
            'Je veux rencontrer Squeezie',
        ]);

        foreach ($users as $user) {
            $rand = rand(0, 100);
            $type = StatusType::all()->shuffle()->first();

            Status::create([
               'user_id' => $user->id,
               'status_type_id' => $type->id,
               'message' => $rand > 50 ? $status->shuffle()->first() : null,
            ]);
        }
    }
}
