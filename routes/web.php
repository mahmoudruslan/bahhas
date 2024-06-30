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
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BhhathController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TransferController;
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

//payment getaway
Route::post('/arb/response', [OrderController::class, 'store']);
// Route::post('/arb/response/true', [PaymentMethodController::class, 'paymentResponse']);
// Route::post('/arb/response/fail', function (Request $request) {
//         dd($request);
    
// });
// Route::post('/arb/response/success', function (Request $request) {
//     dd($request->getOriginalData() );
// });

// Route::post('https://private-anon-061c89e2e8-msegat.apiary-proxy.com/gw/sendsms.php', [AdminController::class, 'test']);


Route::view('/', 'auth.login')->middleware('guest');
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

        Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::resource('admins', AdminController::class)->middleware('can:admins');
            Route::resource('ads', AdController::class)->middleware('can:ads');
            Route::resource('settings', SettingController::class)->middleware('can:settings');
            Route::resource('sliders', SliderController::class)->middleware('can:slider');
            Route::resource('customers', CustomerController::class)->middleware('can:customers');
            Route::resource('cities', CityController::class)->middleware('can:cities');
            Route::resource('addresses', AddressController::class)->middleware('can:addresses');
            Route::resource('categories', CategoryController::class)->middleware('can:categories');
            Route::resource('sub-categories', SubCategoryController::class)->middleware('can:sub-categories');
            Route::resource('transfers', TransferController::class)->middleware('can:transfers');
            Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('can:main');
            Route::resource('products', ProductController::class)->middleware('can:products');
            Route::resource('services', ServiceController::class)->middleware('can:services');
            Route::resource('reviews', ReviewController::class)->middleware('can:reviews');
            Route::resource('coupons', CouponController::class)->middleware('can:coupons');
            Route::resource('blogs', BlogController::class)->middleware('can:blogs');
            Route::resource('experts', ExpertController::class)->middleware('can:experts');
            Route::resource('orders', OrderController::class)->middleware('can:orders');
            Route::resource('permission-roles' , RolePermissionController::class)->middleware('can:roles');//roles and permissions routes
            Route::resource('bank-accounts' , BankAccountController::class)->middleware('can:bank-accounts');//roles and permissions routes
            Route::get('contact-me/edit' , [ContactMeController::class, 'edit'])->name('contact-me.edit')->middleware('can:contact-me');
            Route::get('bhhath/edit' , [BhhathController::class, 'edit'])->name('bhhath.edit')->middleware('can:bhhath');
            Route::post('contact-me/update/{id}' , [ContactMeController::class, 'update'])->name('contact-me.update')->middleware('can:contact-me');
            Route::post('bhhath/update/{id}' , [BhhathController::class, 'update'])->name('bhhath.update')->middleware('can:bhhath');
            Route::get('/export-orders-excel', [OrderController::class, 'exportExcel'])->name('export.excel');
            Route::get('/expert-download/{id}', [ExpertController::class, 'downloadPDF'])->name('expert.download');
            Route::get('/orders/download/{id}', [OrderController::class, 'downloadPDF'])->name('orders.download.attach');
            Route::get('/export-orders-csv', [OrderController::class, 'exportCSV'])->name('export.csv');
            Route::get('/print-orders', [PrintController::class, 'printOrders']);
        });
    }
);
