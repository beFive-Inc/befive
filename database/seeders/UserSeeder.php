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
            'slug' => 'thebester',
            'name' => 'Hoens Anthony',
            'hashtag' => 1000,
            'email' => 'anthony-hoens@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Anthonio97'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'pseudo' => 'Nthn',
            'slug' => 'nthn',
            'name' => 'Minsart Anthony',
            'hashtag' => 1426,
            'email' => 'minsartanthony@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('belgique123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'pseudo' => 'Khonix',
            'slug' => 'khonix',
            'name' => 'Gilson Nicolas',
            'hashtag' => 1007,
            'email' => 'gilsnic@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('p@ssw0rd'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()
            ->times(150)
            ->create();
    }
}
