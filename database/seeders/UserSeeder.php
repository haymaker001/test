<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Administrator',
        	'email' => 'admin@admin.com',
        	'password' => Hash::make('@henriquez') 
        ]);
    }
}
