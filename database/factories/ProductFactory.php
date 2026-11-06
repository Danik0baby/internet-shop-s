<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
        $price = fake()->numberBetween(1_000, 200_000) * 100;
        $hasDiscount = fake()->boolean(30);

        return [
            'category_id' => Category::factory(),
            'slug' => fake()->unique()->slug(3),
            'name' => fake()->words(2, true),
            'brand' => fake()->optional()->company(),
            'description' => fake()->paragraph(),
            'specs' => fake()->optional()->randomElements([
                'Материал' => 'Алюминий',
                'Гарантия' => '2 года',
                'Цвет' => 'Чёрный',
            ], fake()->numberBetween(1, 3), true),
            'image' => null,
            'price' => $price,
            'old_price' => $hasDiscount ? $price + fake()->numberBetween(1_000, 50_000) * 10 : null,
            'stock' => fake()->numberBetween(0, 20),
            'rating' => fake()->randomFloat(1, 3, 5),
            'reviews' => fake()->numberBetween(0, 500),
            'is_featured' => fake()->boolean(30),
        ];
    }

    /**
     * Indicate that the product is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (): array => ['stock' => 0]);
    }
}
