<?php

namespace Database\Seeders;

use App\Models\Chatroom;
use App\Models\ChatroomName;
use Illuminate\Database\Seeder;

class ChatroomNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chatrooms = Chatroom::all();

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

        foreach($chatrooms as $chatroom) {
            $rand = rand(0, 100);
            if ($chatroom->type) {
                ChatroomName::create([
                    'chatroom_id' => $chatroom->id,
                    'title' => $names->shuffle()->first()
                ]);
            } elseif ($rand > 75) {
                ChatroomName::create([
                    'chatroom_id' => $chatroom->id,
                    'title' => $names->shuffle()->first()
                ]);
            }
        }
    }
}
