<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products_count' => Product::count(),
            'users_count'    => User::count(),
            'orders_count'   => 0,
            'revenue'        => 0,
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
