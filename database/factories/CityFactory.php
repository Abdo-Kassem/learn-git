<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
 
    public function definition()
    {
        return [
            'name_ar' => $this->faker->city() . ' ar',
            'name_fr' => $this->faker->city() . ' fr'
        ];
    }
}
