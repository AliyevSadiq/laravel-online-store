<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\MainController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/category/{id}',[HomeController::class,'category'])->name('home.category');
Route::get('/tag/{id}',[HomeController::class,'tag'])->name('home.tag');
Route::get('/product/{id}',[HomeController::class,'productDetail'])->name('home.product');
Route::get('/product-list',[HomeController::class,'productList'])->name('home.product.list');
Route::get('/discount-product',[HomeController::class,'discountList'])->name('home.discount.list');
Route::get('/new-product',[HomeController::class,'newList'])->name('home.new.list');

Route::post('/review',[HomeController::class,'review'])->name('home.product.review');


Route::get('/product-search',[HomeController::class,'search'])->name('home.product.search');

Route::group(['middleware'=>'auth'],function (){
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::get('/profile',[UserController::class,'profile'])->name('profile');
Route::put('/profile',[UserController::class,'profileUpdate'])->name('profile.update');
Route::get('/cart',[CartController::class,'index'])->name('cart.index')->middleware('cart');
Route::get('/cart-add',[CartController::class,'add'])->name('cart.add');
Route::get('/cart-delete',[CartController::class,'delete'])->name('cart.delete');
Route::get('/cart-refresh',[CartController::class,'refresh'])->name('cart.refresh');
Route::get('/order',[CartController::class,'order'])->name('cart.order')->middleware('cart');
Route::post('/order',[CartController::class,'orderForm'])->name('cart.orderForm')->middleware('cart');

});


Route::group(['middleware'=>'guest'],function (){
    Route::get('/register',[UserController::class,'registerForm'])->name('registerForm');
    Route::post('/register',[UserController::class,'register'])->name('register');
    Route::get('/login',[UserController::class,'loginForm'])->name('loginForm');
    Route::post('/login',[UserController::class,'login'])->name('login');
});




Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'admin'],function (){
    Route::get('/',[MainController::class,'index'])->name('admin.index');


    Route::get('/slider',[SliderController::class,'index'])->name('slider.index');
    Route::get('/slider/create',[SliderController::class,'create'])->name('slider.create');
    Route::post('/slider/create',[SliderController::class,'store'])->name('slider.store');
    Route::get('/slider/{id}/edit',[SliderController::class,'edit'])->name('slider.edit')->middleware('slider');
    Route::put('/slider/{id}/update',[SliderController::class,'update'])->name('slider.update')->middleware('slider');
    Route::delete('/slider/{id}/delete',[SliderController::class,'delete'])->name('slider.delete')->middleware('slider');


    Route::get('/category',[CategoryController::class,'index'])->name('category.index');
    Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/category/create',[CategoryController::class,'store'])->name('category.store');
    Route::get('/category/{id}/edit',[CategoryController::class,'edit'])->name('category.edit')->middleware('category');
    Route::put('/category/{id}/update',[CategoryController::class,'update'])->name('category.update')->middleware('category');
    Route::delete('/category/{id}/delete',[CategoryController::class,'delete'])->name('category.delete')->middleware('category');

    Route::get('/tag',[TagController::class,'index'])->name('tag.index');
    Route::get('/tag/create',[TagController::class,'create'])->name('tag.create');
    Route::post('/tag/create',[TagController::class,'store'])->name('tag.store');
    Route::get('/tag/{id}/edit',[TagController::class,'edit'])->name('tag.edit')->middleware('tag');
    Route::put('/tag/{id}/update',[TagController::class,'update'])->name('tag.update')->middleware('tag');
    Route::delete('/tag/{id}/delete',[TagController::class,'delete'])->name('tag.delete')->middleware('tag');


    Route::get('/discount',[DiscountController::class,'index'])->name('discount.index');
    Route::get('/discount/create',[DiscountController::class,'create'])->name('discount.create');
    Route::post('/discount/create',[DiscountController::class,'store'])->name('discount.store');
    Route::get('/discount/{id}/edit',[DiscountController::class,'edit'])->name('discount.edit')->middleware('discount');
    Route::put('/discount/{id}/update',[DiscountController::class,'update'])->name('discount.update')->middleware('discount');
    Route::delete('/discount/{id}/delete',[DiscountController::class,'delete'])->name('discount.delete')->middleware('discount');


    Route::get('/product',[ProductController::class,'index'])->name('product.index');
    Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/product/create',[ProductController::class,'store'])->name('product.store');
    Route::get('/product/{id}/edit',[ProductController::class,'edit'])->name('product.edit')->middleware('product');
    Route::put('/product/{id}/update',[ProductController::class,'update'])->name('product.update')->middleware('product');
    Route::delete('/product/{id}/delete',[ProductController::class,'delete'])->name('product.delete')->middleware('product');
    Route::get('/product/delete-image',[ProductController::class,'deleteImage'])->name('product.delete.image');
    Route::post('/product/add-discount',[ProductController::class,'discount'])->name('product.discount');


    Route::get('/review',[ReviewController::class,'index'])->name('review.index');
    Route::get('/review/{id}/edit',[ReviewController::class,'edit'])->name('review.edit');
    Route::put('/review/{id}/update',[ReviewController::class,'update'])->name('review.update');
    Route::delete('/review/{id}/delete',[ReviewController::class,'delete'])->name('review.delete');




});
