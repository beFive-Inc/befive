<?php

namespace Database\Seeders;

use App\Constant\ChatroomType;
use App\Constant\ChatroomUserStatus;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
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
        $authors = User::where('email', 'LIKE', '%befive-chat.com')
            ->get();

        $chatroom = Chatroom::create([
            'uuid' => Str::uuid(),
            'name' => 'Tfe Anthony Hoens - Befive Chat',
            'type' => null,
        ]);

        $me = ChatroomUser::create([
            'chatroom_id' => $chatroom->id,
            'user_id' => 1,
            'status' => ChatroomUserStatus::ACCEPTED,
            'view_at' => Carbon::now()->addSeconds(10),
        ]);

        foreach ($authors as $author) {
            ChatroomUser::create([
                'chatroom_id' => $chatroom->id,
                'user_id' => $author->id,
                'status' => ChatroomUserStatus::ACCEPTED,
                'view_at' => Carbon::now(),
            ]);
        }

        Message::create([
            'chatroom_user_id' => $me->id,
            'message' => Crypt::encrypt('https://media1.giphy.com/media/d0trZEEmp5zTWmzhBF/giphy.gif?cid=ecf05e47f7dc0ynb1xcfre9uz3r3r4xmprqzm0gzyjtbl6sf&rid=giphy.gif'),
            'created_at' => Carbon::now()->addSeconds(5)
        ]);

        Message::create([
            'chatroom_user_id' => $me->id,
            'message' => Crypt::encrypt('Bonjour et bienvenue dans la découverte de cette nouvelle messagerie instantanée, profitez bien de cette expérience.'),
            'created_at' => Carbon::now()->addSeconds(5)
        ]);


        $canalNames = collect([
            'Rocket league',
            'league of legends',
            'Counter Strike : Global Offensive',
            'Battlefield',
            'Call of Duty',
        ]);

        $users = User::all();

        foreach ($canalNames as $canalName) {
            $canal = Chatroom::create([
                'uuid' => Str::uuid(),
                'name' => $canalName,
                'type' => ChatroomType::CANAL,
            ]);

            ChatroomUser::create([
                'chatroom_id' => $canal->id,
                'user_id' => $users->shuffle()->first()->id,
                'status' => ChatroomUserStatus::ACCEPTED,
                'view_at' => Carbon::now()->addSeconds(10),
            ]);
        }
    }
}
