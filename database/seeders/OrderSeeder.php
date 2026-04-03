<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->where('is_admin', false)->get();
        $products = Product::query()->where('stock', '>', 0)->get();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $orderCount = fake()->numberBetween(1, 3);

            for ($i = 0; $i < $orderCount; $i++) {
                $order = Order::factory()->forUser($user)->create([
                    'status' => fake()->randomElement(['pending', 'processing', 'shipped', 'delivered']),
                ]);

                $selectedProducts = $products->random(fake()->numberBetween(1, min(4, $products->count())));
                $selectedProducts = $selectedProducts instanceof Product ? collect([$selectedProducts]) : $selectedProducts;

                $total = 0;

                foreach ($selectedProducts as $product) {
                    $quantity = fake()->numberBetween(1, 3);
                    $lineTotal = round($quantity * $product->price, 2);

                    OrderItem::factory()->create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                        'total_price' => $lineTotal,
                    ]);

                    $total += $lineTotal;
                }

                $order->update([
                    'total_price' => round($total, 2),
                ]);
            }
        }
    }
}
