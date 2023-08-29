<?php

use App\Http\Controllers\Fontend\IndexController;
use App\Http\Controllers\Fontend\ReviewController;
use App\Http\Controllers\Fontend\WishlistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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



Route::group([], function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::get('/product-details/{slug}', [IndexController::class, 'productDetails'])->name('product.details');
    Route::post('/product-review', [ReviewController::class, 'store'])->name('product.review.store');
    Route::post('/product-wishlist/{id}', [WishlistController::class, 'store'])->name('product.wishlist.store');
    Route::get('/product-wishlist/count', [WishlistController::class, 'wishlistCount'])->name('product.wishlist.count');
    Route::get('/product-quick-view/{id}', [IndexController::class, 'productQuickView']);
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';






