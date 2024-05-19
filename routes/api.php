<?php

use App\Http\Controllers\Api\Admin\AdController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\CartController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\InnerCategoryController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\GovernorateController;
use Illuminate\Support\Facades\Route;


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

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');;
Route::post('/register', [AuthController::class, 'register']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('inner_categories/{category_id}', [CategoryController::class, 'show']);
Route::get('inner_category/products/{inner_category_id}', [InnerCategoryController::class, 'show']);
Route::get('product/types/{id}', [ProductController::class, 'show']); 
Route::get('ads', [AdController::class, 'index']);
Route::get('governorates', [GovernorateController::class, 'index']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('profile/update/{id}', [CustomerController::class, 'update']);
    Route::get('active/account', [AuthController::class, 'activeAccount']);
    Route::get('products', [ProductController::class, 'index']);
    Route::post('order/store', [OrderController::class, 'store']);
    Route::get('customer/orders', [OrderController::class, 'show']);
    Route::delete('order/cancel/{order_id}', [OrderController::class, 'cancel']);
    Route::get('cart', [CartController::class, 'index']);
    Route::post('add-to-cart', [CartController::class, 'store']);
    Route::post('delete/product/cart', [CartController::class, 'deleteProduct']);
    Route::post('delete/cart', [CartController::class, 'deleteCart']);
    Route::post('increase', [CartController::class, 'increase']);
    Route::post('decrease', [CartController::class, 'decrease']);
});
