<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()?->id ?? Product::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->sentence(),
            'approved' => fake()->boolean(80),
        ];
    }
}
