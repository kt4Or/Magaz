<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

/*Route::get('/', function () {
    return view('index');
});*/

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('home');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show'); 
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/del-item{product_id}', [CartController::class, 'delItem'])->name('cart.del_item');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/show', [CartController::class, 'show'])->name('cart.show');
Route::match(['get', 'post'], '/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('index');
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
});


// ==========================================

Route::group(['middleware' => 'guest'], function () {
    // Регистрация
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');


    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});


Route::get('/logout', [UserController::class, 'logout'])->name('logout');




//Route::get('/', '\App\Http\Controllers\ProductController@index')->name('home');

