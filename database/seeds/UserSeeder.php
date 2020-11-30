<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Експерт 1',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('qwerty12'),
                'specialization' => 2,
                'role' => 1
            ],
            [
                'name' => 'Експерт 2',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('qwerty12'),
                'specialization' => 2,
                'role' => 2
            ],
            [
                'name' => 'Експерт 3',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('qwerty12'),
                'specialization' => 2,
                'role' => 3
            ],
            [
                'name' => 'Експерт 4',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('qwerty12'),
                'specialization' => 2,
                'role' => 4
            ],
        ]);
    }
}
