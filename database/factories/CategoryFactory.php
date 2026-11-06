<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'slug' => fake()->unique()->slug(2),
            'name' => mb_convert_case($name, MB_CASE_TITLE, 'UTF-8'),
            'description' => fake()->optional()->sentence(),
            'image' => null,
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }
}
