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
            'name' => fake()->firstName()." ".fake()->numberBetween(0, 500),
            'descriptions' => fake()->safari()." ".fake()->safari()." ".fake()->name(),
            'price' => 5000,
            'stocks' => fake()->numberBetween(0,200),
            'category_id' => Category::inRandomOrder()->first()
        ];
    }
}
