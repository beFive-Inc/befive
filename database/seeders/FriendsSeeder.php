<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 4; $i++) {
                $randUser = $users->except($user->id)->shuffle()->first();
                while ($user->isFriendWith($randUser)) {
                    $randUser = $users->except($user->id)->shuffle()->first();
                }
                $user->befriend(User::find($randUser->id));
                $randUser->acceptFriendRequest(User::find($user->id));
            }
        }
    }
}
