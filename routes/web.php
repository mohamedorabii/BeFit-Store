<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{key}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order-confirmation', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

Route::get('/about', fn () => view('about'))->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



Route::get('/returns', fn () => view('returns'))->name('returns');

Route::get('/faq', function () {
    $faqs = [
        ['question' => 'How long does shipping take?', 'answer' => 'Orders within Cairo and Giza arrive in 24–48 hours. Other governorates typically take 3–5 business days.'],
        ['question' => 'What sizes do you carry?', 'answer' => 'Most items run XS–XXL. Check the size guide on each product page for exact measurements.'],
        ['question' => 'Can I change my order after placing it?', 'answer' => 'Contact us within 1 hour of placing your order and we\'ll do our best to update it before it ships.'],
        ['question' => 'Do you ship internationally?', 'answer' => 'Not yet — we currently ship within Egypt only, with international shipping planned for later this year.'],
    ];

    return view('faq', compact('faqs'));
})->name('faq');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{key}', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::get('/collections', [CollectionController::class, 'index'])->name('collections');
