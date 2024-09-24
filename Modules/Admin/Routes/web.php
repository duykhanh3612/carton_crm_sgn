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
Route::get('zalo-login', function () {
    $code = $_GET['code'];
    $zalo = new \App\Services\Zalo\ZNS();
    $zalo->refreshToken( $code );
    echo 'Cập nhậtAccess token thành công';
});
Route::get('admin/login', 'AuthController@login')->name('admin.user.login');
Route::post('admin/login', 'AuthController@process_login')->name('user.process_login');
Route::get('admin/logout', 'AuthController@logout')->name('admin.logout');
Route::get('admin/profile', 'AuthController@login')->name('user.profile');
Route::prefix('logview')->group(function() {    Route::get('/', 'LogViewController@index');});
$adminPrefix = "admin";
Route::prefix($adminPrefix)->name($adminPrefix . '.')->group(function () {
    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('get.login');
    // Route::post('post-login', 'Auth\LoginController@login')->name('post.login');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('account', 'ProfileController@account')->name('user.account');
        Route::post('account/update', 'ProfileController@update')->name('profile.update');
        Route::post('account/avatar', 'ProfileController@updateAvatar')->name('profile.avatar');
        Route::post('account/update/password', 'ProfileController@updatePassword')->name('profile.update_password');

        Route::get('user', 'UserController@index')->name('user');
        Route::get('member', 'UserController@member')->name('member');
        Route::get('user/add', 'UserController@add')->name('user.add');
        Route::post('user/update-role', 'UserController@updateRole')->name('user.update.role');
        Route::post('user/create', 'UserController@createUser')->name('user.create');

        Route::get('permission', 'UserController@permission')->name('user.permission');
        Route::get('user/update/{id}', 'UserController@update')->name('user.update');
        Route::post('user/save', 'UserController@save')->name('user.save');
        Route::post('user/approve', 'UserController@approve')->name('user.approve');
        Route::post('user/delete', 'UserController@delete')->name('user.delete');
        Route::get('user/assign/{id}', 'UserController@showFormAssign')->name('user.showFormAssign');
        Route::post('user/assign', 'UserController@assign')->name('user.assign');
        Route::get('user/force-login/{id}', 'UserController@forceLogin')->name('user.forceLogin');
        Route::get('/process', 'ProcessController@index')->name('process');
        Route::post('/process/reset', 'ProcessController@reset')->name('process.reset');

        Route::get('shipment', 'ShipmentController@index')->name('shipment');
        Route::get('shipment/create', 'ShipmentController@edit')->name('shipment.create');
        Route::get('shipment/export', 'ShipmentController@export')->name('shipment.export');
        Route::get('shipment/edit/{id}', 'ShipmentController@edit')->name('shipment.edit');
        Route::any('shipment/update','ShipmentController@update')->name('shipment.new');
        Route::post('shipment/delete', 'CoreController@destroy')->name('shipment.destroy');
        Route::get('shipment/delete/{id}', 'CoreController@destroy')->name('shipment.delete');
        Route::any('shipment/update/{id}', 'ShipmentController@update')->name('shipment.update');


        Route::get('order', 'OrderController@index')->name('order');
        Route::post('order/shipment', 'OrderController@shipment');
        Route::get('order/print/{id}', 'OrderController@print')->name('order.print');
        Route::get('order/create', 'OrderController@edit')->name('order.create');
        Route::any('order/update', 'OrderController@update')->name('order.update.new');
        Route::post('order/item', 'OrderController@item')->name('order.item');
        Route::get('order/copy/{id}', 'OrderController@edit')->name('order.copy');
        Route::post('order/update-status', 'OrderController@updateStatus')->name('order.update.status');
        Route::post('order/update-payment', 'OrderController@updatePayment')->name('order.update.payment');
        Route::post('order/update-discount', 'OrderController@updateDiscount')->name('order.update.discount');

        Route::get('order/edit/{id}', 'OrderController@edit')->name('order.edit');
        Route::get('order/delete/{id}', 'OrderController@destroy')->name('order.delete');
        Route::any('order/update/{id}', 'OrderController@update')->name('order.update');

        Route::get('product', 'ProductController@index')->name('product');
        Route::get('product/create', 'ProductController@edit')->name('product.create');
        Route::get('product/export', 'ProductController@export')->name('product.export');
        Route::get('product/copy/{id}', 'ProductController@edit')->name('product.copy');
        Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::post('product/delete', 'CoreController@destroy')->name('product.destroy');
        Route::get('product/delete/{id}', 'ProductController@destroy')->name('product.delete');
        Route::any('product/update', 'ProductController@update')->name('product.update.new');
        Route::any('product/update/{id}', 'ProductController@update')->name('product.update');

        Route::get('customer', 'CustomerController@index')->name('customer');
        Route::get('customer/create', 'CustomerController@edit')->name('customer.create');
        Route::get('customer/export', 'CustomerController@export')->name('customer.export');
        Route::post('customer/update', 'CustomerController@update')->name('customer.create_new');
        Route::any('customer/check_exists', 'CoreController@checkExists')->name('core.pages.check_exists');
        Route::post('customer/delete', 'CustomerController@destroy')->name('product.destroy');
        Route::get('customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
        Route::get('customer/delete/{id}', 'CustomerController@destroy')->name('customer.delete');
        Route::any('customer/update/{id}', 'CustomerController@update')->name('customer.update');

        Route::get('purchase', 'EstateQuotationController@customer')->name('purchase');
        Route::get('stock', 'EstateQuotationController@customer')->name('stock');
        Route::get('revenue', 'ReportController@revenue')->name('revenue');
        Route::any('revenue-type', 'ReportController@revenue_type')->name('revenue.type');
        Route::any('revenue-export', 'ReportController@revenue_export')->name('revenue.export');
        Route::get('payment', 'ReportController@payment')->name('payment');
        Route::get('payment/receipt-voucher', 'ReportController@paymentReceiptVoucher')->name('payment.receipt_voucher');
        Route::any('payment/receipt-voucher-type', 'ReportController@paymentReceiptVoucherType')->name('payment.receipt_voucher.type');
        Route::get('profit', 'EstateQuotationController@customer')->name('profit');
        Route::get('store', 'StoreController@index')->name('store');
        Route::post('store/update', 'StoreController@update')->name('store.update');
        Route::post('uploadPhoto', 'AdminController@uploadPhoto')->name('uploadPhoto');
    });
});
Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin/ajax', 'as' => "admin."], function () {
    Route::any('geo-district', 'AjaxController@getGeoDistrict')->name('ajax.geo.district');
    Route::any('geo-ward', 'AjaxController@getGeoWard')->name('ajax.geo.ward');
    Route::any('update_cols', 'AjaxController@updateColumns')->name('ajax.update_columns');
    Route::any('sort_nestable', 'AjaxController@sort_nestable')->name('ajax.sort_nestable');
    Route::any('change_value', 'AjaxController@change_value')->name('ajax.change_value');
    Route::any('getViewByType/{type}', 'AjaxController@getViewByType')->name('ajax.getViewByType');
    Route::post('upload_file', 'AjaxController@upload_file')->name('ajax.upload_file');
});

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => "admin."], function () {


    Route::get('', 'DashboardController@index')->name("index");
    Route::any('statistical_activities', 'DashboardController@statistical_activities')->name("statistical_activities");
    Route::get('config', 'SettingController@config')->name('config');
    Route::post('config/update', 'SettingController@updateConfig')->name('config.update');
    Route::get('user-setting', 'UserController@setting')->name('user.setting');
    Route::get('user', 'UserController@index')->name('user');
    Route::get('user/permission', 'UserController@add')->name('user.permission');
    Route::get('user/add', 'UserController@add')->name('user.add');
    Route::get('user/update/{id}', 'UserController@update')->name('user.update');


    Route::get('group', 'AdminController@index')->name('group.index');
    Route::get('group/edit/{id}', 'UserController@editGroup')->name('group.edit');
    Route::post('group/update', 'UserController@updateGroup')->name('group.update');
    Route::post('group/update_permission', 'UserController@updateGroupPermission')->name('group.update.permission');
    Route::get('setting', 'SettingController@setting')->name('setting');
    Route::post('setting/update', 'SettingController@updateSettingConfig')->name('setting.update');
    Route::get('settings', 'SettingController@index')->name('settings');
    Route::get('settings/general', 'SettingController@general')->name('settings.general');
    Route::post('settings/update', 'SettingController@updateSetting')->name('settings.update');

    Route::post('/store', 'AdminController@store')->name('page.store');
    // Route::get('{page}', 'AdminController@index')->name('page');
    // Route::get('/{page}/create', 'AdminController@create')->name('page.create');
    // Route::post('/{page}/store', 'AdminController@store')->name('page.store');
    Route::post('/{page}/upload_file', 'AdminController@upload_file')->name('page.upload_file');
    Route::any('/{page}/remove_upload', 'AdminController@remove_upload')->name('page.remove_upload');
    // Route::get('/{page}/edit/{id}', 'AdminController@edit')->name('page.edit');
    // Route::any('/{page}/update', 'AdminController@update');
    // Route::any('/{page}/update/{id}', 'AdminController@update')->name('page.update');
    // Route::get('/{page}/delete/{id}', 'AdminController@destroy')->name('page.delete');

    // Route::any('{slug}', 'CoreController@index')->name('core');
    // Route::any('{slug}/update', 'CoreController@update')->name('core.pages.create');
    // Route::any('{slug}/update/{id}', 'CoreController@update')->name('core.pages.update');
    // Route::any('{slug}/delete/{id}', 'CoreController@delete')->name('core.pages.delete');
    // Route::post('{slug}/process', 'CoreController@process')->name('core.pages.process');
    // Route::any('{slug}/slug_alias', 'CoreController@slugAlias')->name('core.slug_alias');
    // Route::post('{slug}/update_caterogies', 'CoreController@update_caterogies')->name('core.update_caterogies');
    // Route::post('{slug}/process_caterogies', 'CoreController@process_caterogies')->name('core.process_caterogies');
    $modules = \Modules\Admin\Model\Modules::where("menu", "1")->where("file", "<>", "")->whereNotNull("file")->get();
    foreach ($modules as $module) {
        $page = $module->file;
        if (@$module->type == "hyperspace") {
            Route::get($page, 'AdminController@index')->name('page');
            Route::get($page . '/create', 'AdminController@create')->name('page.create');
            Route::post($page . '/store', 'AdminController@store')->name('page.store');
            Route::post($page . '/upload_file', 'AdminController@upload_file')->name('page.upload_file');
            Route::any($page . '/remove_upload', 'AdminController@remove_upload')->name('page.remove_upload');
            Route::get($page . '/edit/{id}', 'AdminController@edit')->name('page.edit');
            Route::any($page . '/update', 'AdminController@update');
            Route::any($page . '/update/{id}', 'AdminController@update')->name('page.update');
            Route::get($page . '/delete/{id}', 'AdminController@destroy')->name('page.delete');
        } elseif ($module->type == "atc") {
            Route::any($page, 'CoreController@index')->name('core');
            Route::any($page . '/update', 'CoreController@update')->name('core.pages.create');
            Route::any($page . '/update/{id}', 'CoreController@update')->name('core.pages.update');
            Route::post($page .'/delete', 'CoreController@destroy')->name('core.delete.ids');
            Route::any($page . '/delete/{id}', 'CoreController@destroy')->name('core.pages.delete');
            Route::any($page . '/process', 'CoreController@process')->name('core.pages.process');
            Route::any($page . '/check_exists', 'CoreController@checkExists')->name('core.pages.check_exists');
            Route::any($page . '/alias', 'CoreController@slugAlias')->name('core.slug_alias');
            Route::any($page . '/update_categories', 'CoreController@updateCategories')->name('core.update_categories');
            Route::any($page . '/process_categories', 'CoreController@processCategories')->name('core.process_categories');
        }
    }

});

