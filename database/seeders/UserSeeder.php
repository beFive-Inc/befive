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
        $hashtag = 1000;
        User::create([
            'uuid' => Str::uuid(),
            'pseudo' => $pseudo = 'Thebester',
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => 'Hoens Anthony',
            'hashtag' => $hashtag,
            'email' => 'anthony-hoens@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Anthonio97'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = 1426;
        User::create([
            'pseudo' => $pseudo = 'Nthn',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => 'Minsart Anthony',
            'hashtag' => $hashtag,
            'email' => 'minsartanthony@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('belgique123'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = 1007;
        User::create([
            'pseudo' => $pseudo = 'Khonix',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => 'Gilson Nicolas',
            'hashtag' => $hashtag,
            'email' => 'gilsnic@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('p@ssw0rd'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = 1234;
        User::create([
            'pseudo' => $pseudo = 'Beauty',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => 'Belboom Natacha',
            'hashtag' => $hashtag,
            'email' => 'natacha.belboom@hotmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('15/09/98'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()
            ->times(25)
            ->create();
    }
}
