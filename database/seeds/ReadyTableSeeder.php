<?php

use Illuminate\Database\Seeder;

class ReadyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ready1 = ['ready' => 0];

        App\Ready::create($ready1);
    }
}
