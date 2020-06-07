<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrontController@home')->name('home');
Route::get('vehicle/{id}', 'FrontController@vehicle_detail')->where('id', '[0-9]+')->name('vehicle.show');
Route::get('vehicles/sort_by/{type}', 'FrontController@vehicles_sort_by')->name('vehicles.sort_by');
Route::get('services/sort_by_service_type/{id}', 'FrontController@services_sort_by_service_type')->name('services.sort_by_service_type');
Route::get('service/{id}', 'FrontController@service_detail')->where('id', '[0-9]+')->name('service.show');
Route::post('register_action', 'FrontController@register_action')->name('register_action');
Route::post('login_action', 'FrontController@login_action')->name('login_action');
Route::get('about', 'FrontController@about')->name('about');
Route::get('terms_and_condition', 'FrontController@terms_and_condition')->name('terms_and_condition');
Route::get('privacy_policy', 'FrontController@privacy_policy')->name('privacy_policy');

Route::middleware('auth')->group(function () {
    Route::get('vehicle/create', 'FrontController@vehicle_create')->name('vehicle.create');
    Route::post('vehicle/store', 'FrontController@vehicle_store')->name('vehicle.store');
    Route::get('logout', 'FrontController@logout')->name('logout');
    Route::post('pay/{for}/{type}/{id}', 'PaymentController@store')->where(['id' => '[0-9]+'])->name('pay');
    Route::get('pay/success/{for}/{type}/{id}', 'PaymentController@success')->where(['id' => '[0-9]+'])->name('pay.success');

});


// Route::get('/admin', 'Admin\AdminController@login');

Route::namespace('Admin')->prefix('admin/')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@login');
    Route::get('login', 'AdminController@login')->name('login');
    Route::post('login_action', 'AdminController@login_action')->name('login_action');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('logout', 'AdminController@logout')->name('logout');
        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('profile', 'AdminController@update_profile')->name('profile');
        Route::post('password/update', 'AdminController@update_password')->name('password.update');
        Route::resource('user', 'UserController');
        Route::resource('vehicle', 'VehicleController');
        Route::resource('service_type', 'ServiceTypeController');
        Route::resource('service', 'ServiceController');
        Route::resource('oreder', 'OrderController');
        Route::resource('payment', 'PaymentController')->only('index', 'show');
        Route::resource('vehicle_book', 'VehicleBookController')->only('index');
        Route::resource('service_book', 'ServiceBookController')->only('index');
        Route::resource('vehicle_purchase', 'VehiclePurchaseController')->only('index');
        Route::post('vehicle/update/is_verified', 'VehicleController@is_verified_update');
        Route::post('vehicle/delete/image', 'VehicleController@image_delete');
        Route::post('service/delete/image', 'ServiceController@image_delete');
    });

});


Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    return 'cache cleared';
});
