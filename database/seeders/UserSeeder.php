<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'username' => 'adminuser',
                'email' => 'admin@gmail',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'status' => 'active'
            ],
            [
                'name' => 'Vendor User',
                'username' => 'vendoruser',
                'email' => 'vendor@gmail',
                'password' => bcrypt('password'),
                'role' => 'vendor',
                'status' => 'active'
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail',
                'password' => bcrypt('password'),
                'role' => 'user',
                'status' => 'active'
            ]
        ]);
    }
}
