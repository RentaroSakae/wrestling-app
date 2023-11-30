<?php

namespace Database\Seeders;

use App\Models\ClassfiedCompetitionPlayer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassfiedCompetitionPlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassfiedCompetitionPlayer::create([
            'classfied_competition_id' => '1',
            'player_id' => '1',
        ]);
    }
}
