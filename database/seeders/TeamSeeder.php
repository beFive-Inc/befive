<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = "SKT T1";

        Team::create([
            'admin_id' => 1,
            'name' => $name,
            'slug' => Str::slug($name),
            'site_url' => '',
            'site_name' => '',
            'description' => 'Lorem Lorem LoremLoremLoremLoremLoremLoremLoremLorem',
        ]);

        Team::factory()
        ->times(30)
        ->create();
    }
}
