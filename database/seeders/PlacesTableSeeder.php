<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Place;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Place::create([
            'name' => '駒沢体育館',
            'address' => '東京都世田谷区',
        ]);

        Place::create([
            'name' => '東京体育館',
            'address' => '東京都綾瀬市',
        ]);

        Place::create([
            'name' => '代々木第一体育館',
            'address' => '東京都新宿区',
        ]);
    }
}
