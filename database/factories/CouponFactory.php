<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CouponFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->bothify('???-##')),
            'discount_percent' => fake()->numberBetween(5, 50),
            'user_id' => User::inRandomOrder()->first()?->id,
            'expires_at' => fake()->dateTimeBetween('+1 week', '+3 months'),
            'is_active' => true,
            'max_uses' => fake()->numberBetween(10, 500),
            'used_count' => fake()->numberBetween(0, 50),
        ];
    }
}
