<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AdController;
use App\Http\Controllers\Api\Admin\AdvisorController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\BhhathController;
use App\Http\Controllers\Api\Admin\BlogController;
use App\Http\Controllers\Api\Admin\CartController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\CheckoutController;
use App\Http\Controllers\Api\Admin\ContactMeController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\ExpertController;
use App\Http\Controllers\Api\Admin\ReviewController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\SubCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

define('PAGINATION', 10);

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('customer/register', [AuthController::class, 'register']);


Route::post('/arb/response', [OrderController::class, 'store']);


Route::group(['middleware' => 'lang'], function(){

    Route::get('product-categories', [CategoryController::class, 'productCategories']);
    Route::get('service-categories', [CategoryController::class, 'serviceCategories']);
    Route::get('advisor-categories', [CategoryController::class, 'advisorCategories']);
    Route::get('sub-categories/{category_id}', [SubCategoryController::class, 'subCategories']);
    Route::get('blogs', [BlogController::class, 'index']);
    Route::get('blogs/{blog_id}', [BlogController::class, 'show']);
    Route::get('services', [ServiceController::class, 'allServices']);
    Route::get('products', [ProductController::class, 'allProducts']);
    Route::get('advisors', [AdvisorController::class, 'allAdvisors']);
    Route::get('services/{service_category_id}', [ServiceController::class, 'categoryServices']);
    Route::get('products/{sub_category_id}', [ProductController::class, 'categoryProducts']);
    Route::get('products/show/{product_id}', [ProductController::class, 'show']);
    Route::get('advisors/{advisor_category_id}', [AdvisorController::class, 'categoryAdvisors']);
    Route::get('ads', [AdController::class, 'index']);
    Route::get('ads/{ad_id}', [AdController::class, 'show']);
    Route::get('sliders', [SliderController::class, 'index']);
    Route::get('sliders/{slider_id}', [SliderController::class, 'show']);
    Route::get('bhhath', [BhhathController::class, 'index']);
    Route::get('contact-me', [ContactMeController::class, 'index']);
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::post('reviews/store', [ReviewController::class, 'store']);
    // Route::get('countries', [ExpertController::class, 'getCountries']);
    // Route::get('cities/{country_id}', [ExpertController::class, 'countryCities']);

    Route::post('experts/store', [ExpertController::class, 'store']);
    Route::group(['middleware' => ['auth:sanctum', 'checkOTPCode']], function () {
        Route::get('customer', [CustomerController::class, 'show']);
        Route::post('customers/update', [CustomerController::class, 'update']);
        Route::delete('customers/delete', [CustomerController::class, 'destroy']);
        Route::get('cart', [CartController::class, 'getCart']);
        Route::post('carts/add-to-cart', [CartController::class, 'store']);
        Route::post('carts/delete-from-cart', [CartController::class, 'deleteProduct']);
        Route::post('carts/decrease', [CartController::class, 'decrease']);
        Route::post('carts/increase', [CartController::class, 'increase']);
        Route::post('orders/store', [OrderController::class, 'store']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/checkout', [CheckoutController::class, 'redirectToCheckoutPage']);
        
        });
    Route::post('/customer/otp-verify', [AuthController::class, 'checkOTPCode'])->middleware('auth:sanctum');
});
