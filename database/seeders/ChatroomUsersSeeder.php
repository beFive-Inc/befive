<?php

namespace Database\Seeders;

use App\Constant\ChatroomStatus;
use App\Constant\ChatroomUserStatus;
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
        $chatrooms = Chatroom::all()->except(1);

        foreach ($chatrooms as $chatroom) {
            $rand = rand(0, 100);
            $otherRand = rand(0, 100);

            $user = User::all()
                ->except(1)
                ->shuffle()
                ->first();

            $otherUser = User::all()
                ->except([1, $user->id]);

            ChatroomUser::create([
                'chatroom_id' => $chatroom->id,
                'user_id' => $rand >= 50 ? 1 : $user->id,
                'view_at' => Carbon::now(),
                'status' => ChatroomUserStatus::ACCEPTED
            ]);

            ChatroomUser::create([
                'chatroom_id' => $chatroom->id,
                'user_id' => $otherUser->shuffle()->first()->id,
                'view_at' => Carbon::now(),
                'status' => ChatroomUserStatus::ACCEPTED
            ]);

            if ($rand >= 75) {
                for ($i = 0; $i < 15; $i++) {
                    ChatroomUser::create([
                        'chatroom_id' => $chatroom->id,
                        'user_id' => $otherUser->shuffle()->first()->id,
                        'view_at' => Carbon::now(),
                        'status' => ChatroomUserStatus::ACCEPTED
                    ]);
                }
            }
            if ($chatroom->isGroup || $chatroom->isConversation) {
                $chatroom->status = ChatroomStatus::PRIVATE;
                $chatroom->save();
            }
        }
    }
}
