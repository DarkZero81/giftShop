<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        // Admins (2)
        \App\Models\User::factory()->count(2)->admin()->create();

        // Regular customers (10)
        \App\Models\User::factory()->count(10)->create();

        // Categories (8)
        \App\Models\Category::factory()->count(8)->create();

        // Products (25) — linked to random categories
        \App\Models\Product::factory()->count(25)->create();

        // Orders (15) — each with realistic items attached
        \App\Models\Order::factory()->count(15)->create();

        // Reviews (30)
        \App\Models\Review::factory()->count(30)->create();

        // Coupons (12)
        \App\Models\Coupon::factory()->count(12)->create();
    }
}
