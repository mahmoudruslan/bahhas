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
use App\Http\Controllers\BhhathController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\InnerCategoryController;
use App\Http\Controllers\ParentCategoryController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ServiceController;
use App\Models\ContactMe;
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
        'middleware' => [
            'localeSessionRedirect', 
            'localizationRedirect', 
            'localeViewPath', 
            'auth']
    ],
    function () {
        // Route::get('customers/documentation', [CustomerController::class, 'allUnverifiedAccounts'])->name('customers.documentation');

        // Route::post('customers/active/{id}', [CustomerController::class, 'active'])->name('customer.active');
        // Route::post('customers/not-active/{id}', [CustomerController::class, 'notActive'])->name('customer.not.active');
        

        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::resource('admins', AdminController::class)->middleware('can:admins');
            Route::resource('ads', AdController::class)->middleware('can:ads');
            Route::resource('customers', CustomerController::class)->middleware('can:customers');
            Route::resource('cities', CityController::class)->middleware('can:cities');
            Route::resource('addresses', AddressController::class)->middleware('can:addresses');
            Route::resource('categories', CategoryController::class)->middleware('can:categories');
            Route::resource('sub-categories', SubCategoryController::class)->middleware('can:sub-categories');
            Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('can:main');
            Route::resource('products', ProductController::class)->middleware('can:products');
            Route::resource('services', ServiceController::class)->middleware('can:services');
            Route::resource('reviews', ReviewController::class)->middleware('can:reviews');
            Route::resource('coupons', CouponController::class)->middleware('can:coupons');
            Route::resource('blogs', BlogController::class)->middleware('can:blogs');
            Route::resource('experts', ExpertController::class)->middleware('can:experts');
            Route::resource('orders', OrderController::class)->middleware('can:orders');
            Route::resource('permission-roles' , RolePermissionController::class)->middleware('can:roles');//roles and permissions routes
            Route::get('contact-me/edit' , [ContactMeController::class, 'edit'])->name('contact-me.edit')->middleware('can:contact-me');
            Route::get('bhhath/edit' , [BhhathController::class, 'edit'])->name('bhhath.edit')->middleware('can:bhhath');
            Route::post('contact-me/update/{id}' , [ContactMeController::class, 'update'])->name('contact-me.update')->middleware('can:contact-me');
            Route::post('bhhath/update/{id}' , [BhhathController::class, 'update'])->name('bhhath.update')->middleware('can:bhhath');
            Route::get('/export-orders-excel', [OrderController::class, 'exportExcel'])->name('export.excel');
            Route::get('/expert-download/{id}', [ExpertController::class, 'download'])->name('expert.download');
            Route::get('/export-orders-csv', [OrderController::class, 'exportCSV'])->name('export.csv');
            Route::get('/print-orders', [PrintController::class, 'printOrders']);
        });
    }
);
