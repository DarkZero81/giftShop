<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Product;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'slug' => fake()->slug(3),
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->randomFloat(2, 10, 500),
            'image' => fake()->imageUrl(600, 400, 'products'),
            'stock' => fake()->numberBetween(0, 200),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
        ];
    }
}
