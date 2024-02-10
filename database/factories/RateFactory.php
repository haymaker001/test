<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => rand(2,251),
            'center_id' => rand(1,30),
            'vehicle_type_id' => rand(1,7),
            'location_id' => rand(1,9999),
            'rate' => rand(500,15000),
            'travel_type_id' => rand(1,2),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
