<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\ShopController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Seller\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/shop', [ShopController::class,'index'])->name('shop.index');
Route::get('/search', [ShopController::class,'search']);

Route::get('/product/{product}',
    [ProductController::class,'show'])
    ->name('product.show');

Route::middleware('auth')->group(function(){

    Route::post('/favorite/{product}',
        [FavoriteController::class,'toggle']);

    Route::get('/favorites',
        [FavoriteController::class,'index']);

});

Route::middleware('auth')->group(function(){
    Route::get('/cart',[CartController::class,'index'])->name('cart.index');
    Route::post('/cart/add/{product}',[CartController::class,'add'])->name('cart.add');
    Route::patch('/cart/update/{cart}',[CartController::class,'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}',[CartController::class,'remove'])->name('cart.remove');
});

Route::middleware('auth')->group(function(){
    Route::post('/product/{product}/review',[ReviewController::class,'store'])->name('review.store');
});

//seller
Route::middleware(['auth'])->group(function(){

    Route::get('/seller/product/create',
        [ProductController::class,'create'])
        ->name('seller.products.create');

    Route::post('/seller/product',
        [ProductController::class,'store'])
        ->name('seller.products.store');

});

Route::middleware(['auth'])->prefix('seller')->group(function(){

    Route::get('/dashboardsell',
        [ProductController::class,'index'])
        ->name('seller.dashboard');

    Route::get('/product/{product}/edit',
        [ProductController::class,'edit'])
        ->name('seller.products.edit');

    Route::put('/product/{product}',
        [ProductController::class,'update'])
        ->name('seller.products.update');

    Route::delete('/product/{product}',
        [ProductController::class,'destroy'])
        ->name('seller.products.destroy');

});

//seller

//buer





Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:seller'])->group(function() {
    Route::get('/seller/orders', [SellerOrderController::class, 'index'])
    ->name('seller.orders');
});


Route::middleware(['role:admin'])->group(function(){

    Route::get('/admin', function(){
        return Inertia::render('Admin/Dashboard');
    });

});

Route::middleware('auth')->group(function(){

    Route::get('/checkout',[CheckoutController::class,'index']);

    Route::post('/checkout',[CheckoutController::class,'store']);

});




require __DIR__.'/auth.php';
