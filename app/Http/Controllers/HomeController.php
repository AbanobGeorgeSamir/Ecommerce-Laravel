<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $newArrivals = Product::with('category')
            ->latest()
            ->take(4)
            ->get();

        $featuredProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->orderByDesc('stock')
            ->take(8)
            ->get();

        $categories = Category::has('products')
            ->take(6)
            ->get();

        return view('home', compact('newArrivals', 'featuredProducts', 'categories'));
    }
}
