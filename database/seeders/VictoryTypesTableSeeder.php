<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VictoryType;

class VictoryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VictoryType::create([
            'name' => 'フォールによる勝利',
            'short_name' => 'VFA',
        ]);

        VictoryType::create([
            'name' => '負傷棄権の試合による勝利',
            'short_name' => 'VIN',
        ]);

        VictoryType::create([
            'name' => '警告3回による勝利',
            'short_name' => 'VCA',
        ]);

        VictoryType::create([
            'name' => 'テクニカルスペリオリティー敗者ポイント無し',
            'short_name' => 'VSU',
        ]);

        VictoryType::create([
            'name' => 'テクニカルスペリオリティー敗者ポイント有り',
            'short_name' => 'VSU1',
        ]);

        VictoryType::create([
            'name' => 'ポイント勝ち 敗者ポイント無し',
            'short_name' => 'VPO',
        ]);

        VictoryType::create([
            'name' => 'ポイント勝ち 敗者ポイント有り',
            'short_name' => 'VPO1',
        ]);

        VictoryType::create([
            'name' => '不戦勝 棄権試合による勝利',
            'short_name' => 'VFO',
        ]);

        VictoryType::create([
            'name' => '罰則による失格',
            'short_name' => 'DSQ',
        ]);

        VictoryType::create([
            'name' => '両者失格',
            'short_name' => '2DSQ',
        ]);
    }
}
