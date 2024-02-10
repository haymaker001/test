<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(TravelTypeSeeder::class);
        //\App\Models\Position::factory(40)->create();
        //\App\Models\SupplyCenter::factory(40)->create();
        $this->call(UserSeeder::class);
        //\App\Models\User::factory(250)->create();
    	$this->call(VehicleTypeSeeder::class);
        $this->call(VehicleGroupSeeder::class);
        //\App\Models\Vehicle::factory(500)->create();
        //\App\Models\Center::factory(30)->create();
        //\App\Models\Location::factory(10000)->create();
        //\App\Models\Rate::factory(24000)->create();
        //\App\Models\Booking::factory(24000)->create();
        //\App\Models\FuelConsumption::factory(40000)->create();
        // \App\Models\User::factory(10)->create();
    }
}
