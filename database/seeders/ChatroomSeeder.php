<?php

namespace Database\Seeders;

use App\Constant\ChatroomStatus;
use App\Constant\ChatroomType;
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
        $canalNames = collect([
            'Rocket league',
            'league of legends',
            'Counter Strike : Global Offensive',
            'Battlefield',
            'Call of Duty',
        ]);

        $names = collect([
            'Les surdoués',
            'Vacances à la plage',
            'Intellos',
            'Devoir de Math',
            'Seigneur',
            'ouiiiiiiiiiiiiiii',
            'Okay',
            'Qui a créé ce groupe ?',
            'Chimpanzés de l\'espace',
        ]);

        for ($i = 1; $i <= 25; $i++) {
            $randType = rand(0, 100);
            Chatroom::create([
                'uuid' => Str::uuid(),
                'name' => $randType > 75 ? $canalNames->shuffle()->first() : $names->shuffle()->first(),
                'type' => $randType > 75 ? ChatroomType::CANAL : null,
            ]);
        }
    }
}
