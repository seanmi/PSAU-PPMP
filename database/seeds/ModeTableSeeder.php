<?php

use Illuminate\Database\Seeder;

class ModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mode1 = ['name' =>'Bidding'];
        $mode2 = ['name' => 'Market'];

        App\ModeOfProcurement::create($mode1);
        App\ModeOfProcurement::create($mode2);
    }
}
