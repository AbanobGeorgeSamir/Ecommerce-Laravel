<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(fake()->numberBetween(1, 2), true);

        return [
            'name' => Str::title($name),
            'description' => fake()->sentence(fake()->numberBetween(10, 16)),
            'image' => null,
        ];
    }
}
