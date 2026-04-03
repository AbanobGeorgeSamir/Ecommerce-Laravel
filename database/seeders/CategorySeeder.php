<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Devices, gadgets, and smart upgrades for modern everyday use.'],
            ['name' => 'Fashion', 'description' => 'Clothing and accessories with a clean, modern feel.'],
            ['name' => 'Home Decor', 'description' => 'Pieces that make workspaces and homes feel warmer and more intentional.'],
            ['name' => 'Beauty', 'description' => 'Daily care essentials and self-care picks customers return to often.'],
            ['name' => 'Sports', 'description' => 'Fitness and performance gear for active routines.'],
            ['name' => 'Books', 'description' => 'Popular reads, practical guides, and giftable titles.'],
        ];

        foreach ($categories as $category) {
            Category::query()->updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($category['name'])],
                $category
            );
        }
    }
}
