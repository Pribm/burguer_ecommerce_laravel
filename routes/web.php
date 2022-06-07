<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Settings\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WebServicesController;
use App\Http\Controllers\StoreSettingsController;
use App\Http\Controllers\Settings\Admin\WebsiteController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CheckoutController;
use App\Mail\orderReceipt;
use Illuminate\Foundation\Auth\User;

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
    Route::post('process_payment', [CheckoutController::class, 'store'])->name('user.finish_order');

    Route::group(['prefix' => 'user'], function() {
        Route::match(['put'], '/update', [UserProfileController::class, 'update'])->name('user.update');

        //Cart
        Route::group(['prefix' => 'cart'], function () {
            Route::get('/calculate_distance/{address_id?}', [CartController::class, 'calculateDistance'])->name('calculate.delivery');
            Route::get('', [CartController::class, 'index'])->name('user.cart');
            Route::get('/{product_id}', [CartController::class, 'create'])->name('insert.cart');
            Route::get('/remove/{product_id}', [CartController::class, 'delete'])->name('remove.cart');

        });

        //Checkout
        Route::group(['prefix' => 'checkout'], function() {
            Route::get('/', [CheckoutController::class, 'index'])->name('user.checkout');
            Route::get('/success', function() {
                return view('user.checkout_success');
            })->name('checkout.success');

        });

        //Profile
        Route::prefix('profile')->group(function () {
            Route::get('/', [UserProfileController::class, 'index'])->name('user.profile');
            Route::post('/changeAvatar', [UserProfileController::class, 'changeAvatar'])->name('user.changeAvatar');
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
        Route::match(['get', 'post'],'update/{id?}/{status?}', [ProductController::class, 'update'])->name('product.update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    });

    Route::group(['prefix' => 'settings'], function() {
        Route::get('/website', [WebsiteController::class, 'create'])->name('main_page_settings.website');
        Route::post('/website', [WebsiteController::class, 'store'])->name('main_page_settings.website');
        Route::get('/website/adress', [WebServicesController::class, 'getLocation'])->name('user.adress');
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



Route::get('product/getThumbnail/{id}/{image}', [ProductController::class, 'getThumbnail'])->name('product.getThumbnail');
Route::get('/get-thumbnail/{path?}', [ImageController::class, 'getThumbnail'])->name('get.image');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/orderReceipt', function() {
    $u = User::find(3);
    return new orderReceipt($u, 3);
});
