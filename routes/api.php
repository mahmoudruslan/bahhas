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
use App\Http\Controllers\Api\Admin\ContactMeController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\ExpertController;
use App\Http\Controllers\Api\Admin\ReviewController;
use App\Http\Controllers\Api\Admin\ServiceController;
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

// Route::post('/login', [AuthController::class, 'login'])->middleware('guest');;
// Route::post('/register', [AuthController::class, 'register']);



Route::group(['middleware' => 'lang'], function(){

    Route::get('product-categories', [CategoryController::class, 'productCategories']);
    Route::get('service-categories', [CategoryController::class, 'serviceCategories']);
    Route::get('advisor-categories', [CategoryController::class, 'advisorCategories']);
    Route::get('sub-categories/{category_id}', [SubCategoryController::class, 'subCategories']);
    Route::get('blogs', [BlogController::class, 'index']);
    Route::get('services', [ServiceController::class, 'allServices']);
    Route::get('products', [ProductController::class, 'allProducts']);
    Route::get('advisors', [AdvisorController::class, 'allAdvisors']);
    Route::get('services/{service_category_id}', [ServiceController::class, 'categoryServices']);
    Route::get('products/{sub_category_id}', [ProductController::class, 'categoryProducts']);
    Route::get('advisors/{advisor_category_id}', [AdvisorController::class, 'categoryAdvisors']);
    Route::get('ads', [AdController::class, 'index']);
    Route::get('bhhath', [BhhathController::class, 'index']);
    Route::get('contact-me', [ContactMeController::class, 'index']);
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::post('reviews/store', [ReviewController::class, 'store']);
    Route::get('countries', [ExpertController::class, 'getCountries']);
    Route::get('cities/{country_id}', [ExpertController::class, 'countryCities']);
    Route::post('experts/store', [ExpertController::class, 'store']);
    Route::post('customers/store', [CustomerController::class, 'store']);
    Route::post('customers/update/{id}', [CustomerController::class, 'update']);
    Route::delete('customers/delete/{id}', [CustomerController::class, 'destroy']);
    Route::get('cart', [CartController::class, 'index']);
    Route::post('carts/add-to-cart', [CartController::class, 'store']);
    Route::post('carts/delete-from-cart', [CartController::class, 'deleteProduct']);
// Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::post('logout', [AuthController::class, 'logout']);
    // Route::post('profile/update/{id}', [CustomerController::class, 'update']);
    // Route::get('active/account', [AuthController::class, 'activeAccount']);
    // Route::post('order/store', [OrderController::class, 'store']);
    // Route::get('customer/orders', [OrderController::class, 'show']);
    // Route::delete('order/cancel/{order_id}', [OrderController::class, 'cancel']);
    // Route::get('cart', [CartController::class, 'index']);
    // Route::post('add-to-cart', [CartController::class, 'store']);
    // Route::post('delete/product/cart', [CartController::class, 'deleteProduct']);
    // Route::post('delete/cart', [CartController::class, 'deleteCart']);

});
