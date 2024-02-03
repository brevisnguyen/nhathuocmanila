<?php

namespace Database\Factories;

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
            'name' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'status' => \App\Enums\Status::IN_STOCK,
            'sold' => fake()->randomNumber(3),
            'description' => fake()->paragraph()
        ];
    }
}
