<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ModeTableSeeder::class);
        $this->call(PositionTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(ReadyTableSeeder::class);
    }
}