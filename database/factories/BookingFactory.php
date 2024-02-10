<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
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
            'user_id' => rand(2,251),
            'vehicle_id' => rand(1,500),
            'driver_id' => rand(2,251),
            'pickup' => now(),
            'dropoff'=> now(),
            'locations' => '1,4,6,7,8,9,13,16',
            'vehicle_type_id' => rand(1,7),
            'rate' => rand(500,15000),
            'travel_type_id' => rand(1,2),
            'diet' => rand(0, 1500),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
