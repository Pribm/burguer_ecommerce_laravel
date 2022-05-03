<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WebServicesController;

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

Route::get('/', [IndexController::class, 'index'])->name('index');

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::group(['prefix' => 'user'], function() {
        Route::match(['put'], '/update', [UserProfileController::class, 'update'])->name('user.update');

        //Cart
        Route::group(['prefix' => 'cart'], function () {
            Route::get('', [CartController::class, 'index'])->name('user.cart');
            Route::get('/{product_id}', [CartController::class, 'create'])->name('insert.cart');
            Route::get('/remove/{product_id}', [CartController::class, 'delete'])->name('remove.cart');
        });

        //Profile
        Route::prefix('profile')->group(function () {
            Route::get('/', [UserProfileController::class, 'index'])->name('user.profile');
            Route::get('/adress', [WebServicesController::class, 'getLocation'])->name('user.adress');
        });
    });
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::group(['prefix' => 'product'], function() {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('create', [ProductController::class, 'create'])->name('product.create');
        Route::get('update/{id?}', [ProductController::class, 'update'])->name('product.update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('getThumbnail/{id}/{image}', [ProductController::class, 'getThumbnail'])->name('product.getThumbnail');
    });

});

/*------------------------------------------
--------------------------------------------
All manager Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});




Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
