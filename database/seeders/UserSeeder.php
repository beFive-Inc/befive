<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'pseudo' => 'Thebester',
            'url' => 'thebester',
            'name' => 'Hoens Anthony',
            'tag' => 1000,
            'email' => 'anthony-hoens@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Anthonio97'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'pseudo' => 'Nthn',
            'url' => 'nthn',
            'name' => 'Minsart Anthony',
            'tag' => 1426,
            'email' => 'minsartanthony@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('belgique123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'pseudo' => 'Khonix',
            'url' => 'khonix',
            'name' => 'Gilson Nicolas',
            'tag' => 1007,
            'email' => 'gilsnic@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('p@ssw0rd'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()
            ->times(40)
            ->create();
    }
}
