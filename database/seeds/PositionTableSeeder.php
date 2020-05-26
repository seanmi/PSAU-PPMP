<?php

use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position1 = ['name' =>'President'];
        $position2 = ['name' =>'VP-ABF'];
        $position3 = ['name' =>'VP-AA'];
        $position4 = ['name' =>'VP-RET'];
        $position5 = ['name' =>'VP-PILLAR4D'];
        $position6 = ['name' =>'BAC Admin'];
        $position7 = ['name' =>'Procurement Admin'];
        $position8 = ['name' =>'Budget Admin'];

        App\Position::create($position1);
        App\Position::create($position2);
        App\Position::create($position3);
        App\Position::create($position4);
        App\Position::create($position5);
        App\Position::create($position6);
        App\Position::create($position7);
        App\Position::create($position8);
    }
}
