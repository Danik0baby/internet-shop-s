<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'number' => 'NV-'.strtoupper(fake()->unique()->bothify('####??')),
            'status' => OrderStatus::New,
            'customer_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->numerify('+7 (9##) ###-##-##'),
            'city' => fake()->city(),
            'address' => fake()->streetAddress(),
            'comment' => fake()->optional()->sentence(),
            'payment_method' => 'cash',
            'delivery_method' => 'courier',
            'total' => fake()->numberBetween(10_000, 500_000),
        ];
    }
}
