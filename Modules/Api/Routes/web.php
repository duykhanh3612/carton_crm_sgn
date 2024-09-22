<?php

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

Route::prefix('api')->group(function (){
    Route::get('/', 'ApiController@index');

    Route::group(['middleware' => 'api', 'namespace' => 'Modules\Api\Http\Controllers', 'prefix' => 'auth'], function () {
        Route::any('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('user', 'AuthController@me');
        Route::any('/google', 'AuthController@google');
        Route::any('/get-google-sign-in-url', 'AuthController@getGoogleSignInUrl');
        Route::any('/callback', 'AuthController@loginCallback');
    });


    Route::group(['middleware' => ['api'], 'namespace' => 'Modules\Api\Http\Controllers'], function () {
        Route::get('intro', 'ApiController@getIntro');
        Route::get('contact', 'ApiController@getContact');
        Route::post('contact', 'ApiController@sendContact');
        Route::get('product/featured', 'ProductController@featured');
        Route::any('get-otp', 'CustomerController@getOtp');
        Route::post('check-otp', 'CustomerController@checkOTP');
        Route::post('customer', 'CustomerController@createCustomer');
        Route::post('forgot-password', 'CustomerController@forgotPassword');
        Route::post('change-password', 'CustomerController@changePassword');
        Route::post('shipment', 'OrderController@shipment');
        Route::get('setting', 'ApiController@setting');
    });
    Route::group(['middleware' => ['api', 'auth:api'], 'namespace' => 'Modules\Api\Http\Controllers'], function () {
        Route::get('customer/profile', 'CustomerController@getProfile');
        Route::post('update-customer', 'CustomerController@updateCustomer');

        Route::post('update-password', 'CustomerController@updatePassword');
        Route::post('orders', 'OrderController@createOrder');
        Route::get('orders/get-code', 'OrderController@getCodeOrder');
        Route::get('orders/history', 'OrderController@getHistory');
    });
    Route::group(['namespace' => 'Modules\Admin\Http\Controllers'], function () {
        Route::get('/{slug}',  'AdminController@api');
        // Route::get('/{slug}/{type}', 'AdminController@api');
        Route::get('/{slug}/{id}',  'AdminController@api_detail');
    });


});
