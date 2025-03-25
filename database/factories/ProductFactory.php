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
            'name' => $this->faker->word,
            'description' => $this->faker->sentence(12),
            'stock' => $this->faker->numberBetween(0, 120),
            'price' => $this->faker->randomFloat(2, 15, 200),
            'category' => $this->faker->randomElement(['go', 'cs', 'php', 'ts'])
        ];
    }
}
