<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;

use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\EnquiryController as AdminEnquiryController;
use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\ReviewController as ProductReviewController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| HOME & NEW ARRIVALS
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/new-arrivals', [HomeController::class, 'newArrivals'])->name('new-arrivals');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

/*
|--------------------------------------------------------------------------
| PROFILE (FIXED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| CART & WISHLIST
|--------------------------------------------------------------------------
*/

Route::post('/wishlist/move-to-cart/{id}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::get('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.remove-coupon');

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/*
|--------------------------------------------------------------------------
| FRONTEND NEWS & REVIEWS & ENQUIRIES
|--------------------------------------------------------------------------
*/

Route::get('/newses', [FrontendNewsController::class, 'index'])->name('frontend.news');

Route::get('/products/{product}/review', [ProductReviewController::class, 'create'])->name('reviews.create');
Route::post('/products/{product}/review', [ProductReviewController::class, 'store'])->name('reviews.store');

Route::get('/products/{product}/enquiry', [EnquiryController::class, 'create'])->name('enquiries.create');
Route::post('/products/{product}/enquiry', [EnquiryController::class, 'store'])->name('enquiries.store');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $products = \App\Models\Product::count();
    $reviews = \App\Models\Review::count();
    $enquiries = \App\Models\Enquiry::count();
    $registrations = \App\Models\Registration::count();
    $news = \App\Models\News::count();

    $latestReviews = \App\Models\Review::latest()->take(5)->get();
    $latestEnquiries = \App\Models\Enquiry::with('product')->latest()->take(5)->get();
    $latestRegistrations = \App\Models\Registration::latest()->take(5)->get();

    // Charts
    $reviewChart = \App\Models\Review::selectRaw('MONTH(created_at) as month, COUNT(*) as total')->groupBy('month')->pluck('total', 'month')->toArray();
    $enquiryChart = \App\Models\Enquiry::selectRaw('MONTH(created_at) as month, COUNT(*) as total')->groupBy('month')->pluck('total', 'month')->toArray();
    $registrationChart = \App\Models\Registration::selectRaw('MONTH(created_at) as month, COUNT(*) as total')->groupBy('month')->pluck('total', 'month')->toArray();

    return view('dashboard', compact(
        'products', 'reviews', 'enquiries', 'registrations', 'news',
        'latestReviews', 'latestEnquiries', 'latestRegistrations',
        'reviewChart', 'enquiryChart', 'registrationChart'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('news', NewsController::class);
    
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    
    Route::get('/enquiries', [AdminEnquiryController::class, 'index'])->name('enquiries.index');
    Route::delete('/enquiries/{enquiry}', [AdminEnquiryController::class, 'destroy'])->name('enquiries.destroy');
    
    Route::get('/registrations', [AdminRegistrationController::class, 'index'])->name('registrations.index');
    Route::delete('/registrations/{registration}', [AdminRegistrationController::class, 'destroy'])->name('registrations.destroy');
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__.'/auth.php';