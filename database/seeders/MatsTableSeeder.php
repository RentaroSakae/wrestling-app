<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mat;

class MatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mat::create([
            'name' => 'Aマット',
            'competition_id' => '1',
        ]);

        Mat::create([
            'name' => 'Bマット',
            'competition_id' => '1',
        ]);

        Mat::create([
            'name' => 'Cマット',
            'competition_id' => '1',
        ]);

        Mat::create([
            'name' => 'Aマット',
            'competition_id' => '2',
        ]);

        Mat::create([
            'name' => 'Bマット',
            'competition_id' => '2',
        ]);

        Mat::create([
            'name' => 'Cマット',
            'competition_id' => '2',
        ]);

        Mat::create([
            'name' => 'Aマット',
            'competition_id' => '3',
        ]);

        Mat::create([
            'name' => 'Bマット',
            'competition_id' => '3',
        ]);

        Mat::create([
            'name' => 'Cマット',
            'competition_id' => '3',
        ]);

        Mat::create([
            'name' => 'Aマット',
            'competition_id' => '4',
        ]);

        Mat::create([
            'name' => 'Bマット',
            'competition_id' => '4',
        ]);

        Mat::create([
            'name' => 'Cマット',
            'competition_id' => '4',
        ]);

        Mat::create([
            'name' => 'Aマット',
            'competition_id' => '5',
        ]);

        Mat::create([
            'name' => 'Bマット',
            'competition_id' => '5',
        ]);

        Mat::create([
            'name' => 'Cマット',
            'competition_id' => '5',
        ]);

        Mat::create([
            'name' => 'Aマット',
            'competition_id' => '6',
        ]);

        Mat::create([
            'name' => 'Bマット',
            'competition_id' => '6',
        ]);

        Mat::create([
            'name' => 'Cマット',
            'competition_id' => '6',
        ]);

        Mat::create([
            'name' => 'Aマット',
            'competition_id' => '7',
        ]);

        Mat::create([
            'name' => 'Bマット',
            'competition_id' => '7',
        ]);

        Mat::create([
            'name' => 'Cマット',
            'competition_id' => '7',
        ]);

        Mat::create([
            'name' => 'Aマット',
            'competition_id' => '8',
        ]);

        Mat::create([
            'name' => 'Bマット',
            'competition_id' => '8',
        ]);

        Mat::create([
            'name' => 'Cマット',
            'competition_id' => '8',
        ]);
    }
}
