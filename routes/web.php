<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\Admin\LoginAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\bannerController;

use App\Models\Category;
use App\Models\Product;
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




Route::get('/', [FrontController::class, 'index'])->name('front.home');
// routes for tesing shop with filters

//Route::get('/shop/{categorySlug}/{subcategorySlug?}/{brandSlug?}', [ShopController::class,'index2'])->name('category');

//end fiters

Route::get('/shop', [ShopController::class, 'index'])->name('front.shop');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [ShopController::class, 'index'])->name('front.shop');
Route::get('/search/products', [ShopController::class, 'index'])->name('front.search');
Route::get('/product/{Slug}', [frontController::class, 'product'])->name('front.product');

Route::get('/cart', [CartController::class, 'index'])->name('front.cart');
Route::post('/cart/add{id}', [CartController::class, 'store'])->name('front.store');
Route::get('/aboutus', [FrontController::class, 'about'])->name('front.about');
Route::get('/contactus', [FrontController::class, 'contact'])->name('front.contact');

Route::get('/account/orders', [FrontController::class, 'orders'])->name('front.orders');

Route::get('/orders/cancel/{id}', [FrontController::class, 'cancelOrder'])
    ->middleware('auth')
    ->name('orders.cancel');

Route::get('/account/wishlist', [FrontController::class, 'wishlist'])->name('front.wishlist');

Route::get('/account/password', [FrontController::class, 'password'])->name('front.password');

Route::post('/account/password', [FrontController::class, 'updatepass'])->name('front.password');

Route::get('/delete{id}', [CartController::class, 'destroy'])->name('cart.delete');

Route::post('/cart/update-quantity/{cartId}', 'CartController@updateQuantity');



Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');

Route::get('/checkou2/{slug}', [CartController::class, 'checkout2'])->name('front.checkout2');
Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');


Route::post('/checkout?from_cart=true', [CartController::class, 'Order_store'])->name('order.storecart');
Route::post('checkout', [CartController::class, 'order_store'])->name('order.store');

Route::get('/thanks', [CartController::class, 'thanks'])->name('orders.thanks');

//routes for normail users
Route::group(['prefix' => 'account'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [FrontController::class, 'login'])->name('login');
        Route::post('/login', [FrontController::class, 'logincheck'])->name('login');
        Route::get('/register', [FrontController::class, 'register'])->name('auth.register');
        Route::post('/register', [FrontController::class, 'store'])->name('auth.store');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [FrontController::class, 'account'])->name('front.profile');
        Route::get('/logout', [FrontController::class, 'logout'])->name('logout');
    });
});




Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {

        Route::get('/login', [LoginAdminController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [LoginAdminController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {

        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');


        //catyegory routes

        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); // working
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create'); //working
        Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store'); //working
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/categories/{id}/edit', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');


        //  brands route

        Route::get('/brand', [BrandController::class, 'index'])->name('brand.index'); // working
        Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create'); //working
        Route::post('/brand/create', [BrandController::class, 'store'])->name('brand.store'); //working
        Route::get('/brand/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('/brand/{id}/edit', [BrandController::class, 'update'])->name('brand.update');
        Route::get('/brand/{id}/delete', [BrandController::class, 'destroy'])->name('brand.destroy');

        Route::get('/brand/search', [BrandController::class, 'search'])->name('brand.search');

        //  Products route

        Route::get('/product', [ProductController::class, 'index'])->name('product.index'); // working
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create'); //working
        Route::post('/product/create', [ProductController::class, 'store'])->name('product.store'); //working
        Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/product/{id}/edit', [ProductController::class, 'update'])->name('product.update');
        Route::get('/product/{id}/delete', [ProductController::class, 'destroy'])->name('product.destroy');

        Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');


        route::get('/orders', [OrdersController::class, 'index'])->name('order.index');
        Route::get('/orders/search', [OrdersController::class, 'search'])->name('orders.search');

        Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
        Route::get('/orders/{orderId}/print-receipt', [OrdersController::class, 'generatePDF'])->name('orders.printReceipt');
        Route::post('/update-order-item-status/{orderItemId}', [OrdersController::class, 'updateOrderItemStatus'])->name('update-order-item-status');


        //banner routes
        Route::get('/banner', [bannerController::class, 'index'])->name('banner.index'); // working
        Route::get('/banner/create', [bannerController::class, 'create'])->name('banner.create'); //working
        Route::post('/banner/create', [bannerController::class, 'store'])->name('banner.store'); //working
        Route::get('/banner/{id}/edit', [bannerController::class, 'edit'])->name('banner.edit');
        Route::post('/banner/{id}/edit', [bannerController::class, 'update'])->name('banner.update');
        Route::get('/banner/{id}/delete', [bannerController::class, 'destroy'])->name('banner.destroy');
        Route::get('/banner/search', [bannerController::class, 'search'])->name('banner.search');

        //customers routes
        Route::get('/customer', [bannerController::class, 'index'])->name('customer.index'); // working
        Route::get('/customer/create', [bannerController::class, 'create'])->name('customer.create'); //working
        Route::post('/customer/create', [bannerController::class, 'store'])->name('customer.store'); //working
        Route::get('/customer/{id}/edit', [bannerController::class, 'edit'])->name('customer.edit');
        Route::post('/customer/{id}/edit', [bannerController::class, 'update'])->name('customer.update');
        Route::get('/customer/{id}/delete', [bannerController::class, 'destroy'])->name('customer.destroy');
        Route::get('/customer/search', [bannerController::class, 'search'])->name('customer.search');
    });
});
