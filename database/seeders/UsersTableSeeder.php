<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => 'Администратор',
            'email' => 'kapuletti@gmail.com',
            'password' => bcrypt('6010745257'),
            'is_admin' => 1,
        ], 
        [
            'name' => 'Евгений',
            'email' => 'jenek0907@mail.ru',
            'password' => bcrypt('12345678'),
            'is_admin' => 0,
        ]]);
    }
}
