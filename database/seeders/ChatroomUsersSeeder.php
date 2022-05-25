<?php

namespace Database\Seeders;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use App\Models\User;
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
        $groups = Chatroom::all();

        foreach ($groups as $group) {
            $rand = rand(0, 100);
            $user = User::all()
                ->except(1)
                ->shuffle()
                ->first();

            $otherUser = User::all()
                ->except([1, $user->id])
                ->shuffle()
                ->first();

            ChatroomUser::create([
                'group_id' => $group->id,
                'user_id' => $user->id,
            ]);

            ChatroomUser::create([
                'group_id' => $group->id,
                'user_id' => 1,
            ]);

            if ($rand >= 75) {
                ChatroomUser::create([
                    'group_id' => $group->id,
                    'user_id' => $otherUser->id,
                ]);
            }
        }
    }
}
