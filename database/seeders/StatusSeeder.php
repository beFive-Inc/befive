<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusType;
use App\Models\User;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
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
            Status::create([
               'user_id' => $user->id,
               'status_type_id' => 1,
               'message' => null,
            ]);
        }
    }
}
