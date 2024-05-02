<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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

Route::as('frontend.')->group(function(){
    //Home page route
    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::get('home',[HomeController::class,'index'])->name('home');
    Route::post('search',[HomeController::class,'search'])->name('search');
    Route::get('payment',[CheckoutController::class,'payment'])->name('payment');

    //Home Frontend Product
    Route::get('show_category/{id}',[CategoryProductController::class,'show_category'])->name('show_category');
    Route::get('show_brand/{id}',[BrandProductController::class,'show_brand'])->name('show_brand');
    Route::get('product_detail/{id}',[ProductController::class,'show_products'])->name('product_detail');

    //Cart
    Route::post('add_cart',[CartController::class,'add_cart'])->name('add_cart');
    Route::get('show_cart',[CartController::class,'show_cart'])->name('show_cart');
    Route::get('delete_cart/{id}',[CartController::class,'delete_cart'])->name('delete_cart');
    Route::post('update_cart_qty',[CartController::class,'update_cart_qty'])->name('update_cart_qty');

    //Frontend Login
    Route::get('login_check',[CheckoutController::class,'login_check'])->name('login_check');
    Route::post('add_customer',[CheckoutController::class,'add_customer'])->name('add_customer');
    Route::get('checkout',[CheckoutController::class,'checkout'])->name('checkout');
    Route::post('save_checkout_customer',[CheckoutController::class,'save_checkout_customer'])->name('save_checkout_customer');
    Route::get('logout',[CheckoutController::class,'logout'])->name('logout');
    Route::post('login',[CheckoutController::class,'login'])->name('login');

    //Order
    Route::post('order_confirm',[CheckoutController::class,'order_confirm'])->name('order_confirm');
});

Route::prefix('admin')->as('admin.')->group(function(){
    //Login
    Route::get('login',[AdminController::class,'index'])->name('login');
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::post('handleLogin',[AdminController::class,'handleLogin'])->name('handleLogin');
    Route::get('logout',[AdminController::class,'logout'])->name('logout');

    //Category routing
    Route::get('add_category',[CategoryProductController::class,'add_category'])->name('add_category');
    Route::get('all_category',[CategoryProductController::class,'all_category'])->name('all_category');

    Route::get('unactive_category_product/{id}',[CategoryProductController::class, 'unactive_category_product'])->name('unactive_category_product');
    Route::get('active_category_product/{id}',[CategoryProductController::class, 'active_category_product'])->name('active_category_product');

    Route::post('save_category_product',[CategoryProductController::class,'save_category_product'])->name('save_category_product');

    Route::get('edit_category_product/{id}',[CategoryProductController::class,'edit_category_product'])->name('edit_category_product');

    Route::get('delete_category_product/{id}',[CategoryProductController::class,'delete_category_product'])->name('delete_category_product');

    Route::post('update_category_product/{id}',[CategoryProductController::class,'update_category_product'])->name('update_category_product');

    //Brand routing
    Route::get('add_brand',[BrandProductController::class,'add_brand'])->name('add_brand');
    Route::get('all_brand',[BrandProductController::class,'all_brand'])->name('all_brand');

    Route::get('unactive_brand_product/{id}',[BrandProductController::class, 'unactive_brand_product'])->name('unactive_brand_product');
    Route::get('active_brand_product/{id}',[BrandProductController::class, 'active_brand_product'])->name('active_brand_product');

    Route::post('save_brand_product',[BrandProductController::class,'save_brand_product'])->name('save_brand_product');

    Route::get('edit_brand_product/{id}',[BrandProductController::class,'edit_brand_product'])->name('edit_brand_product');

    Route::get('delete_brand_product/{id}',[BrandProductController::class,'delete_brand_product'])->name('delete_brand_product');

    Route::post('update_brand_product/{id}',[BrandProductController::class,'update_brand_product'])->name('update_brand_product');

    //Product Routing
    Route::get('add_product',[ProductController::class,'add_product'])->name('add_product');
    Route::get('all_product',[ProductController::class,'all_product'])->name('all_product');

    Route::get('unactive_product/{id}',[ProductController::class, 'unactive_product'])->name('unactive_product');
    Route::get('active_product/{id}',[ProductController::class, 'active_product'])->name('active_product');

    Route::post('save_product',[ProductController::class,'save_product'])->name('save_product');

    Route::get('edit_product/{id}',[ProductController::class,'edit_product'])->name('edit_product');

    Route::get('delete_product/{id}',[ProductController::class,'delete_product'])->name('delete_product');

    Route::post('update_product/{id}',[ProductController::class,'update_product'])->name('update_product');

    //Order Manage
    Route::get('manage_order',[CheckoutController::class,'manage_order'])->name('manage_order');
    Route::get('view_order/{id}',[CheckoutController::class,'view_order'])->name('view_order');
});

