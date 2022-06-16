<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('email', 'LIKE', '%befive-chat.com')
            ->get();

        User::find(1)->addMedia(asset('parts/user/profile_img-' . 1 . '.webp'))
            ->toMediaCollection('profile');

        foreach ($users as $user) {
            $user->addMedia(asset('parts/user/profile_img-' . $user->id . '.webp'))
                ->toMediaCollection('profile');
        }
    }
}
