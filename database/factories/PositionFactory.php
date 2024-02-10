<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->address(),
            'dashboard' => rand(0,1) == 1 ? 'SI' : 'NO',
            'can_see_others_data' => rand(0,1) == 1 ? 'SI' : 'NO',
            'can_see_rates_on_reports' => rand(0,1) == 1 ? 'SI' : 'NO',
            //'email' => $this->faker->unique()->safeEmail(),
            //'cellphone' => Str::random(10),
        ];
    }
}
