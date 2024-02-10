<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_types')->insert([
        	'id' => 9,
        	'name' => 'Cabezote',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_types')->insert([
        	'id' => 10,
        	'name' => 'Rigido',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_types')->insert([
        	'id' => 12,
        	'name' => 'Rescate',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_types')->insert([
        	'id' => 13,
        	'name' => 'Mula',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_types')->insert([
        	'id' => 14,
        	'name' => 'Montacarga',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_types')->insert([
        	'id' => 15,
        	'name' => 'Jenset',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_types')->insert([
        	'id' => 16,
        	'name' => 'Planta Electrica',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);
    }
}
