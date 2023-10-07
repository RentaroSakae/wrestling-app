<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Player::create([
            'name' => '妙心寺洋貴',
            'team_id' => '1',
        ]);

        Player::create([
            'name' => '大沢豊',
            'team_id' => '2',
        ]);

        Player::create([
            'name' => '長家亮',
            'team_id' => '3',
        ]);

        Player::create([
            'name' => '九段輝',
            'team_id' => '4',
        ]);

        Player::create([
            'name' => '見方祐輔',
            'team_id' => '5',
        ]);

        Player::create([
            'name' => '山下翔翼',
            'team_id' => '6',
        ]);

        Player::create([
            'name' => '大西波欧',
            'team_id' => '7',
        ]);

        Player::create([
            'name' => '高田胤辰',
            'team_id' => '8',
        ]);

        Player::create([
            'name' => '西本比田大地',
            'team_id' => '9',
        ]);

        Player::create([
            'name' => '瀬戸上登',
            'team_id' => '10',
        ]);

        Player::create([
            'name' => '武花悠希',
            'team_id' => '11',
        ]);

        Player::create([
            'name' => '安荘厚一',
            'team_id' => '12',
        ]);

        Player::create([
            'name' => '平山記平治',
            'team_id' => '13',
        ]);

        Player::create([
            'name' => '岩中貴史',
            'team_id' => '14',
        ]);

        Player::create([
            'name' => '福居将呂',
            'team_id' => '15',
        ]);

        Player::create([
            'name' => '手老将剛',
            'team_id' => '16',
        ]);
    }
}
