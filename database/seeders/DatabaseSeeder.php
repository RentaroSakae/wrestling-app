<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(CompetitionClassesTableSeeder::class);
        $this->call(CompetitionsTableSeeder::class);
        $this->call(MatsTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
        $this->call(StylesTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VictoryTypesTableSeeder::class);
        $this->call(RoundsTableSeeder::class);
    }
}
