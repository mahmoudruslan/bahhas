<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\InnerCategoryController;
use App\Http\Controllers\ParentCategoryController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ServiceController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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

define('PAGINATION', 20);

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');
Auth::routes(['verify' => true]);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {
        // Route::get('customers/documentation', [CustomerController::class, 'allUnverifiedAccounts'])->name('customers.documentation');

        // Route::post('customers/active/{id}', [CustomerController::class, 'active'])->name('customer.active');
        // Route::post('customers/not-active/{id}', [CustomerController::class, 'notActive'])->name('customer.not.active');
        

        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::resource('admins', AdminController::class);
            Route::resource('ads', AdController::class);
            Route::resource('customers', CustomerController::class);
            Route::resource('cities', CityController::class);
            Route::resource('addresses', AddressController::class);
            Route::resource('parent-categories', ParentCategoryController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('sub-categories', SubCategoryController::class);
            Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
            Route::resource('products', ProductController::class);
            Route::resource('services', ServiceController::class);
            Route::resource('reviews', ReviewController::class);
            Route::resource('coupons', CouponController::class);
            Route::resource('blogs', BlogController::class);
            Route::resource('orders', OrderController::class);
            Route::resource('permission-roles' , RolePermissionController::class);//roles and permissions routes
            Route::get('/export-orders-excel', [OrderController::class, 'exportExcel'])->name('export.excel');
            Route::get('/export-orders-csv', [OrderController::class, 'exportCSV'])->name('export.csv');
            Route::get('/print-orders', [PrintController::class, 'printOrders']);
        });
    }
);
