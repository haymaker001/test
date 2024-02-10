<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TravelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travel_types')->insert([
        	'id' => 1,
        	'name' => 'Sencillo',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('travel_types')->insert([
        	'id' => 2,
        	'name' => 'Dolly / Full',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);
    }
}
