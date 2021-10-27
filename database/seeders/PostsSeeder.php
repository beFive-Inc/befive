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
            'body'=>'je suis un post de test pour thebester',
        ]);
        Post::create([
            'body'=>'je suis un post de test pour nthn',
        ]);
        Post::create([
            'body'=>'je suis un post de test pour Nico',
        ]);
    }
}
