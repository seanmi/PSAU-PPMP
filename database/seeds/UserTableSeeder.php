<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user1 = [
            'email' => 'op@gmail.com',
            'contact_no' => '639554018107',
            'name' => 'Honorio M. Soriano Jr.',
            'password' => bcrypt('password'),
            'department_id' => '1',
            'user_lvl' => '1',
            'position_id' => '1',
        ];

        $user2 = [
            'email' => 'afg@gmail.com',
            'contact_no' => '639554018107',
            'name' => 'Luz D. Merete',
            'password' => bcrypt('password'),
            'department_id' => '2',
            'user_lvl' => '2',
            'position_id' => '2',
        ];

        $user3 = [
            'email' => 'aag@gmail.com',
            'contact_no' => '639554018107',
            'name' => 'Anita G. David',
            'password' => bcrypt('password'),
            'department_id' => '3',
            'user_lvl' => '2',
            'position_id' => '3',
        ];

        $user4 = [
            'email' => 'arg@gmail.com',
            'contact_no' => '639554018107',
            'name' => 'Emelita C. Kempis',
            'password' => bcrypt('password'),
            'department_id' => '4',
            'user_lvl' => '2',
            'position_id' => '4',
        ];

        $user5 = [
            'email' => 'apg@gmail.com',
            'contact_no' => '639554018107',
            'name' => 'Rogelio G. Cosio',
            'password' => bcrypt('password'),
            'department_id' => '5',
            'user_lvl' => '2',
            'position_id' => '5',
        ];

        $user6 = [
            'email' => 'bac@gmail.com',
            'contact_no' => '639554018107',
            'name' => 'BAC Officer',
            'password' => bcrypt('password'),
            'department_id' => '6',
            'user_lvl' => '3',
            'position_id' => '6',
        ];

        $user7 = [
            'email' => 'procurement@gmail.com',
            'contact_no' => '639554018107',
            'name' => 'Procurement Officer',
            'password' => bcrypt('password'),
            'department_id' => '7',
            'user_lvl' => '4',
            'position_id' => '7',
        ];

        $user8 = [
            'email' => 'budget@gmail.com',
            'contact_no' => '639554018107',
            'name' => 'Budget Officer',
            'password' => bcrypt('password'),
            'department_id' => '8',
            'user_lvl' => '5',
            'position_id' => '8',
        ];

        User::create($user1);
        User::create($user2);
        User::create($user3);
        User::create($user4);
        User::create($user5);
        User::create($user6);
        User::create($user7);
        User::create($user8);

    }
}

