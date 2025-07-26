<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_ar' => $this->faker->address() . ' ar',
            'name_fr' => $this->faker->address() . ' fr',
            'city_id' => City::inRandomOrder()->value('id')
        ];
    }
}
