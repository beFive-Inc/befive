<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'content'=>'je suis un post de test pour thebester',
            'user_id'=>1,
        ]);
        Post::create([
            'content'=>'je suis un post de test pour nthn',
            'user_id'=>2
        ]);
        Post::create([
            'content'=>'je suis un post de test pour Nico',
            'user_id'=>3,
        ]);
    }
}
