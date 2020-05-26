<?php

use Illuminate\Database\Seeder;

use App\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department1 = ['name' => 'Office of the President' , 'tag' => 'OP', 'group_id' =>1];
        $department2 = ['name' => 'Vice President for Administration, Business & Finance' , 'tag' => 'VP-ABF', 'group_id' =>1];
        $department3 = ['name' => 'Vice President for Academic Affairs' , 'tag' => 'VP-AA', 'group_id' =>2];
        $department4 = ['name' => 'Vice President for Research, Extension & Training' , 'tag' => 'VP-RET', 'group_id' =>3];   
        $department5 = ['name' => 'Vice President for Planning, Innovation, Linkaging, Land & Agro-ecological Resources for Development' , 'tag' => 'VP-PILLAR4D', 'group_id' =>4];     
        $department6 = ['name' => 'Bids and Awards Committee' , 'tag' => 'bac', 'group_id' =>1];
        $department7 = ['name' => 'Procurement Office' , 'tag' => 'PO', 'group_id' =>1];
        $department8 = ['name' => 'Budget Office' , 'tag' => 'BO', 'group_id' =>1];



        Department::create($department1);
        Department::create($department2);
        Department::create($department3);
        Department::create($department4);
        Department::create($department5);
        Department::create($department6);
        Department::create($department7);
        Department::create($department8);
    }
}

