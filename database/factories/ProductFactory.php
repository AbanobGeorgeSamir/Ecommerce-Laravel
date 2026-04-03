<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(fake()->numberBetween(2, 4), true);

        return [
            'category_id' => Category::factory(),
            'name' => Str::title($name),
            'description' => fake()->paragraphs(fake()->numberBetween(2, 3), true),
            'price' => fake()->randomFloat(2, 19, 799),
            'stock' => fake()->numberBetween(0, 120),
            'image' => null,
        ];
    }

    public function inStock(): static
    {
        return $this->state(fn(array $attributes) => [
            'stock' => fake()->numberBetween(5, 120),
        ]);
    }
}
