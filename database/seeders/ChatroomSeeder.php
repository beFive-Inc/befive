<?php

namespace Database\Seeders;

use App\Models\Chatroom;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChatroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 25; $i++) {
            $randType = rand(0, 100);
            Chatroom::create([
                'uuid' => Str::uuid(),
                'type' => $randType > 75 ? Chatroom::CANAL : null,
            ]);
        }
    }
}
