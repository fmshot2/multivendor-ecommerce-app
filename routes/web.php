<?php

use Illuminate\Support\Facades\Route;

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



//Frontend Section

//authentication


Route::get('user/auth', [App\Http\Controllers\Frontend\IndexController::class, 'userAuth'])->name('user.auth');

Route::post('user/login', [App\Http\Controllers\Frontend\IndexController::class, 'loginSubmit'])->name('login.submit');

Route::post('user/register', [App\Http\Controllers\Frontend\IndexController::class, 'registerSubmit'])->name('register.submit');
Route::get('user/logout', [App\Http\Controllers\Frontend\IndexController::class, 'userLogout'])->name('user.logout');


Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'home'])->name('home');
// Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'home'])->name('home');

//Product category
Route::get('product-category/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'productCategory'])->name('product.category');

//Product detail
Route::get('product-detail/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'productDetail'])->name('product.detail');

//Cart Section
Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'cart'])->name("cart");
Route::post('/cart/store', [App\Http\Controllers\Frontend\CartController::class, 'cartStore'])->name("cart.store");
Route::post('/cart/delete', [App\Http\Controllers\Frontend\CartController::class, 'cartDelete'])->name("cart.delete");
Route::post('/cart/update', [App\Http\Controllers\Frontend\CartController::class, 'cartUpdate'])->name("cart.update");


//Coupon Section
Route::post('coupon/add', [App\Http\Controllers\Frontend\CartController::class, 'couponAdd'])->name("coupon.add");

//Wishlist Section
Route::get('/wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'wishlist'])->name("wishlist");
Route::post('/wishlist/store', [App\Http\Controllers\Frontend\WishlistController::class, 'wishlistStore'])->name("wishlist.store");
Route::post('/wishlist/move-to-cart', [App\Http\Controllers\Frontend\WishlistController::class, 'moveToCart'])->name("wishlist.move.cart");
Route::post('/wishlist/delete', [App\Http\Controllers\Frontend\WishlistController::class, 'wishlistDelete'])->name("wishlist.delete");
// Route::post('/cart/update', [App\Http\Controllers\Frontend\CartController::class, 'cartUpdate'])->name("cart.update");

//End Frontend Section

//the ['register'=>false] below removes the register link from
// dashboard after logging in
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

// Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user']], function () {


//Admin dashboard

Route::group(['prefix' => 'admin/', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');

    // Banner
    // Route::resource('banner', \App\Http\Controllers\BannerController::class);


    // Banner Section
    Route::resource('/banner', \App\Http\Controllers\BannerController::class);
    Route::post('banner_status', [App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');

    // Category Section
    Route::resource('/category', \App\Http\Controllers\CategoryController::class);
    Route::post('category_status', [App\Http\Controllers\CategoryController::class, 'categoryStatus'])->name('category.status');

    Route::post('category/{id}/child', [App\Http\Controllers\CategoryController::class, 'getChildByParentID']);

    // Brand Section
    Route::resource('/brand', \App\Http\Controllers\BrandController::class);
    Route::post('brand_status', [App\Http\Controllers\BrandController::class, 'brandStatus'])->name('brand.status');

    // Product Section
    Route::resource('/product', \App\Http\Controllers\ProductController::class);
    Route::post('product_status', [App\Http\Controllers\ProductController::class, 'productStatus'])->name('product.status');

    // User Section
    Route::resource('/user', \App\Http\Controllers\UserController::class);
    Route::post('user_status', [App\Http\Controllers\UserController::class, 'userStatus'])->name('user.status');

    // Coupon Section
    Route::resource('/coupon', \App\Http\Controllers\CouponController::class);
    Route::post('coupon_status', [App\Http\Controllers\CouponController::class, 'couponStatus'])->name('coupon.status');

    // Shipping Section
    Route::resource('/shipping', \App\Http\Controllers\ShippingController::class);
    Route::post('shipping_status', [App\Http\Controllers\ShippingController::class, 'shippingStatus'])->name('shipping.status');

});

Route::group(['prefix' => 'seller', 'middleware' => ['auth', 'seller']], function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin'])->name('seller');
});

//User Dashboard
Route::group(['prefix' => 'user'], function () {
    Route::get('/dashboard', [App\Http\Controllers\Frontend\IndexController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/order', [App\Http\Controllers\Frontend\IndexController::class, 'userOrder'])->name('user.order');
    Route::get('/address', [App\Http\Controllers\Frontend\IndexController::class, 'userAddress'])->name('user.address');
    Route::get('/account-detail', [App\Http\Controllers\Frontend\IndexController::class, 'userAccount'])->name('user.account');

//billing
    Route::post('/billing/address/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'billingAddress'])->name('billing.address');
    Route::post('/shipping/address/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'shippingingAddress'])->name('shipping.address');

    Route::post('/update/account/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'updateAccount'])->name('update.account');

});
