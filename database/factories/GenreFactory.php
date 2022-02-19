<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->country(),
            'description' => rand(0, 10) % 2 == 0 ? $this->faker->sentence() : null,
            'is_active' => $this->faker->boolean()
        ];
    }
}
