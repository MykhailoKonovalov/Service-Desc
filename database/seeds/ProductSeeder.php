<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['title' => 'Вебсайт'],
            ['title' => 'iOS додаток'],
            ['title' => 'Android додаток'],
            ['title' => 'Технічний стан машини'],
        ]);
    }
}
