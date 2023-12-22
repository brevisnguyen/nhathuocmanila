<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medication>
 */
class MedicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'components' => fake()->words(),
            'price' => fake()->randomNumber(4),
            'cost' => fake()->randomNumber(4),
            'inventory' => fake()->randomNumber(3),
            'sold_count' => fake()->randomNumber(3),
            'image' => fake()->imageUrl(),
            'description' => fake()->paragraph()
        ];
    }
}
