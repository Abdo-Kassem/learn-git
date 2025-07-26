<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryId = Category::inRandomOrder()->first('id');

        return [
            'name_ar' => $this->faker->word() . ' ar',
            'name_fr' => $this->faker->word() . ' fr',
            'image' => $this->faker->imageUrl(),
            'category_id' => $categoryId
        ];
    }
}
