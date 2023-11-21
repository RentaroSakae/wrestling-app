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
            'category_id' => '4',
            'start_at' => '2023-10-01 00:00:00',
            'close_at' => '2023-10-01 23:59:00',
        ]);

        Competition::create([
            'name' => '大会②',
            'place_id' => '2',
            'category_id' => '4',
            'start_at' => '2023-10-02 00:00:00',
            'close_at' => '2023-10-02 23:59:00',
        ]);

        Competition::create([
            'name' => '大会③',
            'place_id' => '3',
            'category_id' => '4',
            'start_at' => '2024-10-03 00:00:00',
            'close_at' => '2024-10-03 23:59:00',
        ]);

        Competition::create([
            'name' => '大会④',
            'place_id' => '1',
            'category_id' => '4',
            'start_at' => '2024-10-04 00:00:00',
            'close_at' => '2024-10-04 23:59:00',
        ]);

        Competition::create([
            'name' => '大会⑤',
            'place_id' => '2',
            'category_id' => '4',
            'start_at' => '2022-10-05 00:00:00',
            'close_at' => '2022-10-05 23:59:00',
        ]);

        Competition::create([
            'name' => '大会⑥',
            'place_id' => '3',
            'category_id' => '4',
            'start_at' => '2023-10-05 00:00:00',
            'close_at' => '2024-10-06 00:00:00',
        ]);

        Competition::create([
            'name' => '大会⑦',
            'place_id' => '1',
            'category_id' => '4',
            'start_at' => '2022-08-01 00:00:00',
            'close_at' => '2022-08-01 23:59:00',

        ]);

        Competition::create([
            'name' => '大会⑧',
            'place_id' => '2',
            'category_id' => '4',
            'start_at' => '2022-07-01 00:00:00',
            'close_at' => '2022-07-01 23:59:00',
        ]);
    }
}
