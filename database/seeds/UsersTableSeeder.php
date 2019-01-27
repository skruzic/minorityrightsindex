<?php

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
        DB::table('users')->insert([
            'name'     => 'Stanko Kruzic',
            'email'    => 'skruzic@gmail.com',
            'password' => bcrypt('110885'),
        ]);

        DB::table('users')->insert([
            'name'     => 'Kosta Bovan',
            'email'    => 'bovanko@gmail.com',
            'password' => bcrypt('Ko1950Bo'),
        ]);
    }
}
