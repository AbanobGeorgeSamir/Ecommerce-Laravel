<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }

    return view('welcome-gate');
});

Route::get('/store', [HomeController::class, 'index'])->name('home');

Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{product:slug}', 'show')->name('show');
});

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/add', 'add')->name('add');
    Route::post('/update', 'update')->name('update');
    Route::post('/remove', 'remove')->name('remove');
    Route::post('/clear', 'clear')->name('clear');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return auth()->user()->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('orders.index');
    })->name('dashboard');

    Route::controller(OrderController::class)->prefix('orders')->name('orders.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{order}', 'show')->name('show');
    });
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});

Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $stats = [
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'users_count' => User::count(),
            'orders_count' => Order::count(),
            'revenue' => Order::where('status', 'delivered')->sum('total_price'),
        ];

        return view('admin.dashboard', compact('stats'));
    })->name('dashboard');

    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class)->except('show');
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'destroy']);
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__ . '/auth.php';
