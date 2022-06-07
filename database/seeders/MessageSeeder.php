<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\ChatroomUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $message = collect([
            'Coucou',
            'Hello',
            'Bonjour',
            'Ca va ?',
            'Je ne peux pas, j\'ai foot',
            'Je ne suis pas dispo',
            'Bisous',
            'Tu fais quoi ?',
            'Rien',
            'Petit lapin',
            'Il y a pas des emoji sur cette app ?',
            'Non, c\'est hyper naze',
            'Pas de soucis',
            'Désolé',
            'Il fait beau',
            'Je te connais ?',
            "C'est pas vrai",
            "Tu es qui ?"
        ]);
        $members = ChatroomUser::all();

        foreach ($members as $member) {
            $randMessage = rand(1, 5);
            for($i = 0; $i < $randMessage; $i++) {
                $randMessageAction = rand(0, 100);
                $messageAction = Message::all()
                    ->where('chatroom_user_id', $member->id);

                Message::create([
                    'chatroom_user_id' => $member->id,
                    'message_id' => $randMessageAction > 75 && count($messageAction) ? $messageAction->shuffle()->first()->id : null,
                    'message' => Crypt::encrypt($message->shuffle()->first())
                ]);
            }
        }
    }
}
