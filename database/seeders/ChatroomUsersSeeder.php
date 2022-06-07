<?php

namespace Database\Seeders;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ChatroomUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chatrooms = Chatroom::all();

        foreach ($chatrooms as $chatroom) {
            $rand = rand(0, 100);
            $otherRand = rand(0, 100);
            $manyUser = rand(20, 100);

            $user = User::all()
                ->except(1)
                ->shuffle()
                ->first();

            $otherUser = User::all()
                ->except([1, $user->id]);

            if ($otherRand >= 50) {
                ChatroomUser::create([
                    'chatroom_id' => $chatroom->id,
                    'user_id' => $user->id,
                    'view_at' => Carbon::now()
                ]);
            }

            ChatroomUser::create([
                'chatroom_id' => $chatroom->id,
                'user_id' => 1,
                'view_at' => Carbon::now()
            ]);

            ChatroomUser::create([
                'chatroom_id' => $chatroom->id,
                'user_id' => $otherUser->shuffle()->first()->id,
                'view_at' => Carbon::now()
            ]);

            if ($rand >= 75) {
                for ($i = 0; $i < $manyUser; $i++) {
                    ChatroomUser::create([
                        'chatroom_id' => $chatroom->id,
                        'user_id' => $otherUser->shuffle()->first()->id,
                        'view_at' => Carbon::now()
                    ]);
                }
            }
        }
    }
}
