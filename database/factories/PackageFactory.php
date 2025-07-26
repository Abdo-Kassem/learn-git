<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    
    public function definition()
    {
        return [
            'name_ar' => $this->faker->word() . ' ar',
            'name_fr' => $this->faker->word() . ' fr',
            'days_number' => $this->faker->numberBetween(1,30),
            'price' => $this->faker->numberBetween(99, 2000),
            'category_id' => Category::inRandomOrder()->value('id'),
            'description_ar' => $this->faker->text() . ' ar',
            'description_fr' => $this->faker->text() . ' fr',
            'image' => $this->faker->imageUrl
        ];
    }
}
