<?php

namespace Database\Seeders;

use App\Models\Friend;
use Illuminate\Database\Seeder;

class FriendsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Friend::create([
            'user_id_from' => 1,
            'user_id_to' => 2,
            'isAccepted' => true,
            'created_at' => now(),
            'updated_at' => null
        ]);
        Friend::create([
            'user_id_from' => 1,
            'user_id_to' => 3,
            'isAccepted' => true,

            'created_at' => now(),
            'updated_at' => null
        ]);
        Friend::create([
            'user_id_from' => 2,
            'user_id_to' => 3,
            'isAccepted' => true,

            'created_at' => now(),
            'updated_at' => null
        ]);
        Friend::create([
            'user_id_from' => 3,
            'user_id_to' => 1,
            'isAccepted' => true,

            'created_at' => now(),
            'updated_at' => null
        ]);
        Friend::create([
            'user_id_from' => 3,
            'user_id_to' => 1,
            'isAccepted' => true,

            'created_at' => now(),
            'updated_at' => null
        ]);
    }
}
