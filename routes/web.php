<?php

use App\Http\Controllers\Auth\PasswordResetOtpController;
use App\Http\Controllers\BackEnd\OtpController;
use App\Http\Controllers\BackEnd\SocialAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Social Login
Route::middleware('guest')->group(function () {
    Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
        ->name('social.redirect');

    Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
        ->name('social.callback');
});

// Laravel Authentication
Auth::routes([
    'reset' => false,
    'verify' => false,
]);


// Password Reset with OTP
Route::middleware('guest')->group(function () {

    Route::get('/password/reset', [PasswordResetOtpController::class, 'create'])
        ->name('password.request');

    Route::post('/password/email', [PasswordResetOtpController::class, 'send'])
        ->name('password.email');

    Route::get('/password/reset/code', [PasswordResetOtpController::class, 'showOtp'])
        ->name('password.otp.show');

    Route::post('/password/reset/code', [PasswordResetOtpController::class, 'verify'])
        ->name('password.otp.verify');

    Route::get('/password/reset/new', [PasswordResetOtpController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/password/reset/new', [PasswordResetOtpController::class, 'reset'])
        ->name('password.update');
});


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Shop
Route::get('/shop', [ShopController::class, 'index'])
    ->name('shop');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories');

// Subcategories
Route::get('/subcategories', [SubcategoryController::class, 'index'])
    ->name('subcategories.index');

// Collections
Route::get('/collections', [CollectionController::class, 'index'])
    ->name('collections');

// Products
Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.show');

// About
Route::view('/about', 'about')
    ->name('about');

// Contact
Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

// Returns
Route::view('/returns', 'returns')
    ->name('returns');

// FAQ
Route::get('/faq', function () {

    $faqs = [
        [
            'question' => 'How long does shipping take?',
            'answer' => 'Orders within Cairo and Giza arrive in 24–48 hours. Other governorates typically take 3–5 business days.',
        ],
        [
            'question' => 'What sizes do you carry?',
            'answer' => 'Most items run XS–XXL. Check the size guide on each product page for exact measurements.',
        ],
        [
            'question' => 'Can I change my order after placing it?',
            'answer' => 'Contact us within 1 hour of placing your order and we\'ll do our best to update it before it ships.',
        ],
        [
            'question' => 'Do you ship internationally?',
            'answer' => 'Not yet — we currently ship within Egypt only, with international shipping planned for later this year.',
        ],
    ];

    return view('faq', compact('faqs'));
})->name('faq');


/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/cart/update/{cart}', [CartController::class, 'updateQuantity'])
    ->name('cart.update');

Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])
    ->name('cart.remove');


/*
|--------------------------------------------------------------------------
| Wishlist
|--------------------------------------------------------------------------
*/

Route::get('/wishlist', [WishlistController::class, 'index'])
    ->name('wishlist');

Route::post('/wishlist/add', [WishlistController::class, 'add'])
    ->name('wishlist.add');

Route::delete('/wishlist/remove/{key}', [WishlistController::class, 'remove'])
    ->name('wishlist.remove');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'confirmation'])
        ->name('checkout.confirmation');


    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */

    Route::get('/orders', [OrdersController::class, 'index'])
        ->name('orders.index');

    Route::patch('/orders/{order}/cancel', [OrdersController::class, 'cancel'])
        ->name('orders.cancel');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | OTP Verification
    |--------------------------------------------------------------------------
    */

    Route::get('/verify-otp', [OtpController::class, 'show'])
        ->name('otp.show');

    Route::post('/verify-otp/send', [OtpController::class, 'send'])
        ->name('otp.send');

    Route::post('/verify-otp/verify', [OtpController::class, 'verify'])
        ->name('otp.verify');
});
