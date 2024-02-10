<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <10 ; $i++) { 
        	DB::table('positions')->insert([
	        	'name' => $this->faker->name(),
	        	'description' => null,
	        	'dashboard' => rand(0,1) == 1 ? 'SI' : 'NO',
	        ]);
        }
    }
}
