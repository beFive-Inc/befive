<?php

namespace Database\Seeders;

use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expiredAt = Carbon::now()->addMinutes(5);

        $users = User::all();

        foreach ($users as $user) {
            Session::create([
               'user_id' => $user->id,
               'last_activity' => $expiredAt,
            ]);
        }
    }
}
