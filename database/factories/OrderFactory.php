<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'total' => fake()->randomFloat(2, 20, 1000),
            'status' => fake()->randomElement(['pending', 'processing', 'completed', 'cancelled', 'refunded']),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'customer_address' => fake()->address(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $itemsCount = fake()->numberBetween(1, 4);
            $products = \App\Models\Product::inRandomOrder()->limit($itemsCount)->get();

            foreach ($products as $product) {
                \App\Models\OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'quantity' => fake()->numberBetween(1, 5),
                ]);
            }
        });
    }
}
