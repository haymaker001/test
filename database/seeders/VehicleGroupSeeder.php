<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class VehicleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_groups')->insert([
        	'id' => 1,
        	'name' => 'Default',
        	'description' => 'Default vehicle group',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_groups')->insert([
        	'id' => 2,
        	'name' => 'MF',
        	'description' => 'Merca Frio',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_groups')->insert([
        	'id' => 3,
        	'name' => 'CDSL',
        	'description' => 'Centro Distribución San Luis',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_groups')->insert([
        	'id' => 4,
        	'name' => 'Frito Lay',
        	'description' => 'Frito Lay',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_groups')->insert([
        	'id' => 5,
        	'name' => 'Caucedo',
        	'description' => 'Caucedo',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_groups')->insert([
        	'id' => 6,
        	'name' => 'Bepensa',
        	'description' => 'Bepensa',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);

        DB::table('vehicle_groups')->insert([
        	'id' => 7,
        	'name' => 'SUB CONTRATADO',
        	'description' => 'Vehiculos que dan servicios subcontratados',
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);
    }
}
