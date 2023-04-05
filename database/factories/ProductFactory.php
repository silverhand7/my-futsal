<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->sentence(2),
            'category_id' => Category::inRandomOrder()->first()->id,
            'price' => fake()->randomElement([1000, 2000, 3000, 4000, 5000]),
            'stock' => '5',
        ];
    }
}
