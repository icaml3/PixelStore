<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'full_name' => 'Admin User',
                'email' => 'hlamm2706@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('hailam2706'),
                'phone' => '0123456789',
                'role' => 1,
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'User Example',
                'email' => 'hhlamm2706@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('hailam2706'),
                'phone' => '0987654321',
                'role' => 2,
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
