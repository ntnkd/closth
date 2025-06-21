<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Services\UploadService;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product-detail', [HomeController::class, 'productDetail'])->name('product-detail');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/product-detail/{id}', [HomeController::class, 'productDetail'])->name('product-detail');
Route::get('/category/{id}-{slug}.html', [HomeController::class, 'category'])->name('category.show');


Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'adminIndex'])->middleware(['auth', 'admin']);

    #Category
    Route::prefix('category')->group(function () {
        Route::get('/add', [CategoryController::class, 'create']);
        Route::post('/add', [CategoryController::class, 'store']);
        Route::get('/list', [CategoryController::class, 'index']);
        Route::get('/edit/{category}', [CategoryController::class, 'show']);
        Route::post('/edit/{category}', [CategoryController::class, 'update']);
        Route::DELETE('/destroy', [CategoryController::class, 'destroy']);
    });

    #Product
    Route::prefix('product')->group(function () {
        Route::get('/add', [ProductController::class, 'create']);
        Route::post('/add', [ProductController::class, 'store']);
        Route::get('/list', [ProductController::class, 'index']);
        Route::get('/edit/{product}', [ProductController::class, 'show']);
        Route::post('/edit/{product}', [ProductController::class, 'update']);
        Route::DELETE('/destroy', [ProductController::class, 'destroy']);
    });

    #slider
    Route::prefix('slider')->group(function () {
        Route::get('/add', [SliderController::class, 'create']);
        Route::post('/add', [SliderController::class, 'store']);
        Route::get('/list', [SliderController::class, 'index']);
        Route::get('/edit/{slider}', [SliderController::class, 'show']);
        Route::post('/edit/{slider}', [SliderController::class, 'update']);
        Route::DELETE('/destroy', [SliderController::class, 'destroy']);
    });


    #upload
    Route::post('/upload/services', [UploadController::class, 'store']);

})->middleware(['auth', 'admin']);
