<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competition;

class CompetitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Competition::create([
            'name' => '大会①',
            'place_id' => '1',
        ]);

        Competition::create([
            'name' => '大会②',
            'place_id' => '2',
        ]);

        Competition::create([
            'name' => '大会③',
            'place_id' => '3',
        ]);

        Competition::create([
            'name' => '大会④',
            'place_id' => '1',
        ]);

        Competition::create([
            'name' => '大会⑤',
            'place_id' => '2',
        ]);

        Competition::create([
            'name' => '大会⑥',
            'place_id' => '3',
        ]);

        Competition::create([
            'name' => '大会⑦',
            'place_id' => '1',

        ]);

        Competition::create([
            'name' => '大会⑧',
            'place_id' => '2',
        ]);
    }
}
