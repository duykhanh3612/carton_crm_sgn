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

Route::prefix('modules')->group(function() {
    Route::get('/', 'ModulesController@index');
});

Route::get("goto", 'ModulesController@goto');
Route::get("run_app",function(){


    // Execute Notepad with the created file
    //C:\Users\Desktop\AppData\Local\Programs\Microsoft VS Code\Code.exe

    // PATH_VSCODE = 'C:\Users\Desktop\AppData\Local\Programs\Microsoft VS Code\Code.exe'
    // PATH_SOURCE = 'I:\DeviTech\carton\crm.carton\'
    shell_exec('"'.env("PATH_VSCODE").'"   --goto "'.env("PATH_SOURCE").'public\module\order\script.js":77:1');
    die;
});

Route::prefix('logview')->group(function () {
    Route::get('/', 'LogViewController@index');
});
Route::get("symlink","SymlinkController@symlink");
Route::get('route', "SymlinkController@routes");
Route::get("symlink/modules",function(){
    $target = base_path("Modules/Modules/Resources/assets");
    $short_cut = base_path("public/modules");

    if(file_exists($short_cut)) unlink("public/modules");
    // $target =  "Modules/Modules/Resources/assets";
    // $short_cut = "public/modules";
    symlink($target, $short_cut);
});
Route::get("symlink/api",function(){
    $target =  base_path("Modules/Api/Resources/assets");
    $short_cut = base_path("public/api");
    symlink($target, $short_cut);
});
Route::get("symlink/module/{module}",function($module){
    // $target =  base_path("Modules/Admin/Resources");
    // $short_cut = base_path("public/module/".$module);
    // symlink($target, $short_cut);

    $target =  base_path("public/module/".$module);
    $short_cut = base_path("Modules/Admin/Resources/views/".$module.'/assets');
    symlink($target, $short_cut);
});

Route::get("symlink/mix",function(){
    $target = base_path("Modules/Admin/Resources/views");
    $short_cut = base_path("public/module");
    symlink($target, $short_cut);
});
Route::group(['middleware' => 'auth:admin','prefix' => 'admin','as'=>"admin."], function () {
    Route::get('/modules', 'ModulesController@index')->name("modules");

    Route::any('/modules/guide', 'ModulesController@guide');
    Route::any('/modules/info', 'ModulesController@info');
    Route::get('/modules/update/{id}', 'ModulesController@update');
    Route::any('/modules/process', 'ModulesController@process');


    Route::get('/modules_function', 'ModulesFunctionController@index');
    Route::get('/modules_function/update/{id}', 'ModulesFunctionController@update');
    Route::any('/modules_function/process', 'ModulesFunctionController@process');

    Route::get('option_items_keynum', 'OptionItemsKeyNumController@index');
    Route::get('option_items_keynum/update', 'OptionItemsKeyNumController@update');
    Route::get('option_items_keynum/update/{id}', 'OptionItemsKeyNumController@update');
    Route::any('option_items_keynum/process', 'OptionItemsKeyNumController@process');

    Route::any('modules/column_options', 'ModulesController@column_options')->name('column_options');
    Route::any('modules/update_cols', 'ModulesController@updateColumns')->name('ajax.update_columns');
    Route::any('modules/column_options/{type}', 'ModulesController@column_options')->name('column_part_options');
    Route::any('modules/column_settings', 'ModulesController@column_settings')->name('column_settings');
    Route::any('modules/get_field_by_table/{table}', 'ModulesController@get_field_by_table')->name('get_field_by_table');
    Route::any('modules/sync_orders_status', 'ModulesController@sync_orders_status')->name('sync_orders_status');
    Route::any('modules/sync_option_items_keynum', 'ModulesController@sync_option_items_keynum')->name('sync_option_items_keynum');


});
