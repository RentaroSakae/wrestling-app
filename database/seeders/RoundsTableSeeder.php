<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Round;

class RoundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Round::create([
            'round' => '予備選',
        ]);

        Round::create([
            'round' => '1回戦',
        ]);

        Round::create([
            'round' => '2回戦',
        ]);

        Round::create([
            'round' => '3回戦',
        ]);

        Round::create([
            'round' => '4回戦',
        ]);

        Round::create([
            'round' => '準々決勝',
        ]);

        Round::create([
            'round' => '準決勝',
        ]);

        Round::create([
            'round' => '決勝',
        ]);
    }
}
