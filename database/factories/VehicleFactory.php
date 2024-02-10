<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $type_id = rand(12,16);

        return [
            'name' => 'F-' . mt_rand(1,99999),
            'model' => Str::random(10),
            'type_id' => $type_id,
            'vehicle_type_id' => $type_id,
            'year' => rand(1978, 2022),
            'vehicle_group_id' => rand(1,7),
            'engine_type' => rand(1,2) == 1 ? 'Normal' : 'Sencillo',
            'horse_power' => rand(8000, 12000),
            'color' => 'Marca',
            'vin' => mt_rand(60000,90000),
            'is_reportable' => rand(0,1),
        ];
    }
}
