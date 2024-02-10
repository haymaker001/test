<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'location' => $this->faker->name(),
            'customer_id' => rand(2,251),
            'location_type' => rand(1,2) == 1 ? 'DT' : 'PD',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
