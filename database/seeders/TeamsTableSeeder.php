<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'name' => '日本体育大学',
        ]);

        Team::create([
            'name' => '早稲田大学',
        ]);

        Team::create([
            'name' => '山梨学院大学',
        ]);

        Team::create([
            'name' => '拓殖大学',
        ]);

        Team::create([
            'name' => '専修大学',
        ]);

        Team::create([
            'name' => '国士舘大学',
        ]);

        Team::create([
            'name' => '日本大学',
        ]);

        Team::create([
            'name' => '中央大学',
        ]);

        Team::create([
            'name' => '育英大学',
        ]);

        Team::create([
            'name' => '明治大学',
        ]);

        Team::create([
            'name' => '神奈川大学',
        ]);

        Team::create([
            'name' => '東洋大学',
        ]);

        Team::create([
            'name' => '立教大学',
        ]);

        Team::create([
            'name' => '青山学院大学',
        ]);

        Team::create([
            'name' => '大東文化大学',
        ]);

        Team::create([
            'name' => '法政大学',
        ]);

        Team::create([
            'name' => 'なし（シード）',
        ]);
    }
}
