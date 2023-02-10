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

Route::get('/', function () {
    return view('welcome');
});

//the ['register'=>false] below removes the register link from
// dashboard after logging in
Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin dashboard

Route::group(['prefix'=>'admin/','middleware'=>'auth'], function(){
    Route::get('/',[App\Http\Controllers\AdminController::class, 'admin'])->name('admin');

    // Banner
    Route::resource('banner', \App\Http\Controllers\BannerController::class);
});

// Banner Section
Route::resource('/banner', \App\Http\Controllers\BannerController::class);
Route::post('banner_status', [App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');

// Category Section
Route::resource('/category', \App\Http\Controllers\CategoryController::class);
Route::post('category_status', [App\Http\Controllers\CategoryController::class, 'categoryStatus'])->name('category.status');
