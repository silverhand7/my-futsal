<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'no' => Sale::all()->count() + 1,
            'product_id' => Product::inRandomOrder()->first()->id,
            'sold_at' => Carbon::today()->subDays(rand(0, 60))->toDateString(),
            'qty' => fake()->randomElement([5, 4, 3, 2, 1]),
        ];
    }
}
