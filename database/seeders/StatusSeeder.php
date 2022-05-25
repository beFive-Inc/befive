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

        $status = [
            'Je suis là',
            'En pleine partie',
            'Venez parler',
            'J\'aime tout le monde'
        ];

        foreach ($users as $user) {
            $rand = rand(0, count($status) - 1);
            $type = StatusType::all()->shuffle()->first();

            Status::create([
               'user_id' => $user->id,
               'type_id' => $type->id,
               'message' => $status[$rand],
            ]);
        }
    }
}
