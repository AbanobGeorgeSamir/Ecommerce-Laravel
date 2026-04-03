<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            'Electronics' => [
                ['name' => 'Wireless Noise-Canceling Headphones', 'price' => 249.99, 'stock' => 34],
                ['name' => '4K Smart Monitor', 'price' => 319.00, 'stock' => 12],
                ['name' => 'Portable Bluetooth Speaker', 'price' => 89.50, 'stock' => 46],
            ],
            'Fashion' => [
                ['name' => 'Minimal Leather Backpack', 'price' => 129.99, 'stock' => 18],
                ['name' => 'Classic Overshirt Jacket', 'price' => 74.90, 'stock' => 28],
                ['name' => 'Everyday Knit Sneakers', 'price' => 94.00, 'stock' => 22],
            ],
            'Home Decor' => [
                ['name' => 'Ceramic Table Lamp', 'price' => 69.90, 'stock' => 20],
                ['name' => 'Textured Throw Blanket', 'price' => 44.50, 'stock' => 27],
                ['name' => 'Oak Wall Shelf', 'price' => 58.25, 'stock' => 14],
            ],
            'Beauty' => [
                ['name' => 'Hydrating Skincare Set', 'price' => 54.99, 'stock' => 31],
                ['name' => 'Vitamin C Daily Serum', 'price' => 27.50, 'stock' => 40],
                ['name' => 'Gentle Face Cleanser', 'price' => 18.90, 'stock' => 52],
            ],
            'Sports' => [
                ['name' => 'Performance Yoga Mat', 'price' => 39.99, 'stock' => 25],
                ['name' => 'Adjustable Dumbbell Pair', 'price' => 199.00, 'stock' => 9],
                ['name' => 'Insulated Training Bottle', 'price' => 21.75, 'stock' => 47],
            ],
            'Books' => [
                ['name' => 'Designing Better Products', 'price' => 26.00, 'stock' => 16],
                ['name' => 'Practical Startup Systems', 'price' => 31.40, 'stock' => 11],
                ['name' => 'Mindful Work Habits', 'price' => 19.95, 'stock' => 24],
            ],
        ];

        foreach ($catalog as $categoryName => $products) {
            $category = Category::query()->where('name', $categoryName)->first();

            if (! $category) {
                continue;
            }

            foreach ($products as $product) {
                Product::query()->updateOrCreate(
                    ['slug' => \Illuminate\Support\Str::slug($product['name'])],
                    [
                        'category_id' => $category->id,
                        'name' => $product['name'],
                        'description' => fake()->paragraphs(2, true),
                        'price' => $product['price'],
                        'stock' => $product['stock'],
                        'image' => null,
                    ]
                );
            }
        }

        Product::factory()
            ->count(18)
            ->inStock()
            ->recycle(Category::all())
            ->create();
    }
}
