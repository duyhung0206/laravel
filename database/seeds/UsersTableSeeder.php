<?php

use Illuminate\Database\Seeder;

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
            'name' => 'Nguyễn Duy Hùng',
            'email' => 'hung2061994@gmail.com',
            'password' => bcrypt('h122122777'),
        ]);
    }
}
