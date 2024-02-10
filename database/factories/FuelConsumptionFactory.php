<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FuelConsumption>
 */
class FuelConsumptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'supply_center_id' => rand(1,40),
            'vehicle_id' => rand(1,500),
            'initial_odometer' => rand(1,30),
            'final_odometer' => rand(500,1500),
            'number_of_gallons' => rand(10,20),
            'created_date' => date('Y-m-d'),
            'total_mileage' => rand(48,200),
            'overall_yield' => rand(10,25),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
