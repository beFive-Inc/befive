<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            FriendsSeeder::class,
            SessionSeeder::class,
            ChatroomSeeder::class,
            ChatroomUsersSeeder::class,
            MessageSeeder::class,
            StatusTypeSeeder::class,
            StatusSeeder::class,
            UserImgSeeder::class,
        ]);
    }
}
