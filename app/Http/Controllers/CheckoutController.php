<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Cart session expired.');
        }

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'address' => 'required|string|max:500',
        ]);

        DB::beginTransaction();

        try {
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'user_id' => Auth::id(),
                'name'    => strip_tags($request->name),
                'email'   => filter_var($request->email, FILTER_SANITIZE_EMAIL),
                'address' => strip_tags($request->address),
                'total_price' => $total,
                'status'  => 'pending',
            ]);

            foreach ($cart as $id => $item) {
                $product = Product::find($id);

                if (!$product || $product->stock < $item['quantity']) {
                    throw new \Exception("Sorry, {$item['name']} just went out of stock.");
                }

                $product->decrement('stock', $item['quantity']);

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $id,
                    'quantity'   => (int)$item['quantity'],
                    'price'      => $item['price'],
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('home')->with('success', "Order #{$order->id} placed successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Checkout Error: " . $e->getMessage());

            return back()->withInput()->with('error', $e->getMessage() ?: 'Something went wrong. Please try again.');
        }
    }
}
