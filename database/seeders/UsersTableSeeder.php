<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => '栄廉太郎',
            'email' => 'r.sakae0508@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('3460spsp'), // 適切なパスワードを設定
        ]);
    }
}
