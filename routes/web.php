<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('admin', function () {
    return 'Admin Page';
})->middleware('auth', 'admin');

Route::get('/combo', function () {
    return view('layouts.app');
});
Route::get('/guest', function () {
    return view('layouts.guest');
});

// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/products', [ProductController::class, 'index']);

Route::post('upload', [ImageController::class, 'upload'])->name('images.upload');
Route::delete('revert', [ImageController::class, 'revert'])->name('images.revert');

// Admin Route
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('brands', BrandController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('products', ProductController::class);
    Route::resource('stocks', StockController::class);

});

// User Route
Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('user.checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('user.checkout.store');
    Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('user.checkout.show');

    Route::post('/orders', [App\Http\Controllers\User\OrderController::class, 'store'])->name('user.orders.store');
    Route::get('/orders', [App\Http\Controllers\User\OrderController::class, 'index'])->name('user.orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\User\OrderController::class, 'show'])->name('user.orders.show');
    Route::get('/orders/cancel/{order}', [App\Http\Controllers\User\OrderController::class, 'cancelOrder'])->name('user.orders.cancel');


});

// Guest Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [App\Http\Controllers\Guest\ProductController::class, 'index'])->name('guest.products.index');
Route::get('/products/{product}', [App\Http\Controllers\Guest\ProductController::class, 'show'])->name('guest.products.show');

Route::get('/cart', [CartController::class, 'index'])->name('guest.cart.index');
Route::post('/cart/store', [CartController::class, 'store'])->name('guest.cart.store');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('guest.cart.update');
Route::get('/cart/{id}', [CartController::class, 'destroy'])->name('guest.cart.destroy');

Route::post('/webhook', [App\Http\Controllers\User\OrderController::class, 'webhook'])->name('user.orders.webhook');




Route::middleware(['auth'])->group(function () {
    // Route::get('/', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::resource('images', ImageController::class);

    // Route::get('/products/import/create', [ProductController::class, 'importCreate'])->name('products.import.create');
    // Route::post('/products/import', [ProductController::class, 'importStore'])->name('products.import.store');
    // Route::get('/products/excel', [ProductController::class, 'excel'])->name('products.excel');
    // Route::get('/products/pdf', [ProductController::class, 'pdf'])->name('products.pdf');
    // Route::resource('products', ProductController::class);
});


Route::prefix('prototype')->group(function () {
    Route::get('homepage', function () {
        return view('prototype.homepage');
    })->name('homepage');

    Route::get('kaos', function () {
        return view('prototype.kaos');
    })->name('kaos');

    Route::get('detail', function () {
        return view('prototype.detail');
    })->name('detail');

    Route::get('cart', function () {
        return view('prototype.cart');
    })->name('cart');

    Route::get('checkout', function () {
        return view('prototype.checkout');
    })->name('checkout');
});

