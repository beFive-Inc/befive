<?php

namespace Database\Seeders;

use App\Models\StatusType;
use Illuminate\Database\Seeder;

class StatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'En ligne',
            'Absent',
            'Occupé',
            'Hors Ligne',
        ];

        foreach ($types as $type) {
            StatusType::create([
               'name' => $type,
            ]);
        }
    }
}
