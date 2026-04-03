<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($validated['id']);
        $quantityToAdd = (int) ($validated['quantity'] ?? 1);

        if ($quantityToAdd < 1) {
            return redirect()->back()->with('error', 'Quantity must be at least 1.');
        }

        $cart = session()->get('cart', []);
        $currentQtyInCart = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;

        if (($currentQtyInCart + $quantityToAdd) > $product->stock) {
            return redirect()->back()->with('error', "Only {$product->stock} units are available. You already have {$currentQtyInCart} in your cart.");
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantityToAdd;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantityToAdd,
                "price" => $product->price,
                "image" => $product->image,
                "slug" => $product->slug,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer'],
            'action' => ['required', 'in:increase,decrease'],
        ]);

        $cart = session()->get('cart', []);
        $id = $validated['id'];
        $action = $validated['action'];

        if (isset($cart[$id])) {
            $product = Product::find($id);

            if (! $product) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->back()->with('error', 'This product is no longer available.');
            }

            if ($action === 'increase') {
                if ($cart[$id]['quantity'] < $product->stock) {
                    $cart[$id]['quantity']++;
                } else {
                    return redirect()->back()->with('error', 'Maximum stock reached for this item.');
                }
            } elseif ($action === 'decrease') {
                if ($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity']--;
                } else {
                    unset($cart[$id]);
                }
            }

            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Product removed.');
        }

        return redirect()->back()->with('error', 'Product not found in your cart.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('products.index')->with('success', 'Cart cleared.');
    }
}
