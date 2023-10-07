<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Style;

class StylesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Style::create([
            'name' => 'FS',
        ]);

        Style::create([
            'name' => 'GR',
        ]);

        Style::create([
            'name' => 'WW',
        ]);

        Style::create([
            'name' => '男子',
        ]);

        Style::create([
            'name' => '女子',
        ]);
    }
}
