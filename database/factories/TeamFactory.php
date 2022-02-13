<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userID = User::all()->shuffle()->except(1)->first()->id;
        $name = str_replace('.', '', $this->faker->realText('20'));
        $url = $this->faker->domainName;

        return [
            'admin_id' => $userID,
            'name' => $name,
            'slug' => Str::slug($name),
            'site_url' => $url,
            'site_name' => $url,
            'description' => $this->faker->paragraphs('1', true),
        ];
    }
}
