v<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $g1 = ['name'=> 'VP-ABF'];
        $g2 = ['name'=> 'VP-AA'];
        $g3 = ['name'=> 'VP-RET'];
        $g4 = ['name'=> 'VP-PILLAR4D'];

        App\Group::create($g1);
        App\Group::create($g2);
        App\Group::create($g3);
        App\Group::create($g4);
    }
}
