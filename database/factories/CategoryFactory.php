<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_ar' => $this->faker->word() . ' ar',
            'name_fr' => $this->faker->word() . ' fr',
            'image' => $this->faker->imageUrl(),
        ];
    }
}
