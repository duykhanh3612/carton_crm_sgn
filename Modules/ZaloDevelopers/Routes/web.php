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

Route::group(['middleware' => 'auth:admin','prefix' => 'zalodevelopers'], function () {
    Route::get('/', 'ZaloDevelopersController@index');
    Route::get('/otp', 'OAController@otp')->name("zalo.otp");
    Route::get('/otp/resend/{id}', 'OAController@otp_resend')->name("zalo.otp.resend");
    Route::post('/otp/delete', 'OAController@otp_destroy')->name('zalo.otp.delete.ids');
    Route::any('/otp/delete/{id}', 'OAController@otp_destroy')->name('zalo.otp.pages.delete');

    Route::get('/oa', 'OAController@index')->name("zalo.oa");
    Route::get('/oa/download/{id}', 'OAController@download')->name("zalo.oa.download");
    Route::get('/oa/download-zns/{id}', 'OAController@downloadZNS')->name("zalo.oa.download.zns");
    Route::get('/template', 'TemplateController@index')->name("zalo.zns.template");
    Route::get('/template/download', 'TemplateController@download')->name("zalo.zns.template.download");
    Route::get('/template/download_info/{id}', 'TemplateController@downloadInfo')->name("zalo.zns.template.download.info");
    Route::get('/template/test/{id}', 'TemplateController@testTemplate')->name("zalo.zns.template.test");
});
