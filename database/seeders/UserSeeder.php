<?php

namespace Database\Seeders;

use App\Models\User;
use App\Traits\Operator;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    use Operator;
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

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Simkis',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-1@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('@yBNhmEdBQnYG?4K'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Trituga',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-2@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('$Ap$!tSrD8xdcXRt'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Curys',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-3@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Y?MQFxA9tjrqtyJ6'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Vilne',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-4@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('#GrCr&ps$$N6BaQa'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Ydanio',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-5@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('#@4MaPpLYx$G75dh'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Neurovanal',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-6@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('9iL#GeMqox3dq583'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Exrys',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-7@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('C5rq!$dCQqCJy?Te'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Hipark',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-8@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('3R!rrQa7?PDBsnEs'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Zuldribeo',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-9@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('3nh@EdfinSmAYt9n'),
            'remember_token' => Str::random(10),
        ]);

        $hashtag = $this->getRandomHashtag();
        User::create([
            'pseudo' => $pseudo = 'Xumix',
            'uuid' => Str::uuid(),
            'slug' => Str::slug($pseudo) . '.' . $hashtag,
            'name' => null,
            'hashtag' => $hashtag,
            'email' => 'user-10@befive-chat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('8npdMrYH8p&#5PPJ'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()
            ->times(20)
            ->create();
    }
}
