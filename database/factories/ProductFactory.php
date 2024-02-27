<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Brand;
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
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'sku' => fake()->unique()->randomNumber(),
            'description' => fake()->sentence(5),
            'size_guide' => fake()->sentence(5),
            'price' => fake()->randomNumber(1, 1000),
            'image' => "default.png",
            'brand_id' => Brand::factory(),
            'team_id' => Team::factory(),
            'type' => fake()->randomElement(['home', 'away', 'third', 'GK']),

        ];
    }
}
