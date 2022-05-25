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
        $users = User::limit(10)->get();

        foreach ($users as $user) {
            $user->addMedia(storage_path("app/public/user/profile_img_$user->id.webp"))->toMediaCollection('profile');
        }
    }
}
