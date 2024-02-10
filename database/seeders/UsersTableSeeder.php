<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

            //Admin
            [
                'full_name' => 'Femi Admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'admin',
                'status' => 'active',
            ],

            //Vendor
            [
                'full_name' => 'Femi Seller',
                'username' => 'seller',
                'email' => 'seller@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'seller',
                'status' => 'active',
            ],

            //Customer
            [
                'full_name' => 'Femi Customer',
                'username' => 'Customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'customer',
                'status' => 'active',
            ]
        ]);
    }
}
