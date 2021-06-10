<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SslCommerzPaymentController;
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
// Auth Routes
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::post('/home', [HomeController::class, 'index'])->name('home');
Route::get('/download/invoice/{order_id}', [HomeController::class, 'downloadinvoice'])->name('home.invoice');

Route::get('/', [FrontendController::class, 'home'])->name('tohoney');
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('tohoney.contact');
Route::post('/contact', [FrontendController::class, 'contactform']);
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('category/shop/{category_id}', [FrontendController::class, 'categoryshop'])->name('categoryshop');
Route::get('/productdetails/{product_id}', [FrontendController::class, 'productdetails'])->name('productdetails');
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/cart/{coupon_name}', [FrontendController::class, 'cart'])->name('cart.coupon');
Route::post('/cartupdate', [FrontendController::class, 'updatecart'])->name('cart.update');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [FrontendController::class, 'storeorder']);
Route::post('/city/checkout', [FrontendController::class, 'cities']);
Route::get('/customer/register', [FrontendController::class, 'registerform'])->name('customer.register');
Route::post('/customer/register', [FrontendController::class, 'register']);

Route::get('/customer/login', [FrontendController::class, 'loginform'])->name('customer.login');
Route::post('/customer/login', [FrontendController::class, 'login']);


//Category
Route::get('/category', [CategoryController::class, 'category']) -> name('category');
Route::post('/category/post', [CategoryController::class, 'categorypost']) -> name('categorypost');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'categorydelete']) -> name('categorydelete');
Route::get('/category/all/delete', [CategoryController::class, 'categoryalldelete']) -> name('categoryalldelete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'categoryedit']) -> name('categoryedit');
Route::post('/category/post/edit', [CategoryController::class, 'categoryeditpost']) -> name('categoryeditpost');
Route::post('/category/selected/delete', [CategoryController::class, 'categoryselectedelete']) -> name('categoryselectedelete');
Route::get('/category/restore/{category_id}', [CategoryController::class, 'categoryrestore']) -> name('categoryrestore');
Route::get('/category/force/delete/{category_id}', [CategoryController::class, 'categoryforcedelete']) -> name('categoryforcedelete');
Route::get('/category/allrestore', [CategoryController::class, 'categoryallrestore']) -> name('categoryallrestore');
Route::get('/category/allforce/delete', [CategoryController::class, 'categoryallforcedelete']) -> name('categoryallforcedelete');

//Product
Route::get('/product', [ProductController::class, 'product']) -> name('product');
Route::post('/product/post', [ProductController::class, 'productpost']) -> name('productpost');
Route::get('/product/edit/{product_id}', [ProductController::class, 'productedit']) -> name('productedit');
Route::post('/product/post/edit/{product_id}', [ProductController::class, 'producteditpost']) -> name('producteditpost');
Route::get('/product/delete/{product_id}', [ProductController::class, 'productdelete']) -> name('productdelete');

//FAQ
Route::get('/faq', [FaqController::class, 'index']) -> name('faq');
Route::post('/faq', [FaqController::class, 'faqpost']);
Route::get('/faqedit/{faq_id}', [FaqController::class, 'faqedit']) -> name('faqedit');
Route::post('/faqupdate', [FaqController::class, 'faqupdate']) -> name('faqupdate');
Route::get('/faqdelete/{faq_id}', [FaqController::class, 'faqdelete']) -> name('faqdelete');

// Settings
Route::get('/setting', [SettingController::class, 'index']) -> name('setting');
Route::post('/setting', [SettingController::class, 'update']);

//cart
Route::post('/cart/{product_id}', [CartController::class, 'cartadd']) -> name('cartadd');
Route::get('/cart/delete/{product_id}', [CartController::class, 'cartdelete'])->name('cartdelete');

//Banner
Route::get('/banner', [BannerController::class, 'index']) -> name('banner');
Route::post('/banner', [BannerController::class, 'store']);
Route::get('/banner/delete/{banner_id}', [BannerController::class, 'delete']) -> name('bannerdelete');
Route::get('/banner/edit/{banner_id}', [BannerController::class, 'edit']) -> name('banneredit');
Route::post('/banner/edit/{banner_id}', [BannerController::class, 'update']);

Route::resource('testimonial', TestimonialController::class);

//Coupon
Route::resource('coupon', CouponController::class);

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
