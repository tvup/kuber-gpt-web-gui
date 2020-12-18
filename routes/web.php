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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::get('/home', 'HomeController@index')->name('home');

Route::get('/read_index', 'CertificatoController@read_index')->name('readindex');

Route::get('/downloadmycert', 'UserController@downloadmycert')->name('user_downloadmycert');




Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {

    //Route::redirect('/', '/admin/dashboard', 301);
    Route::get('/', 'CertificatoController@popolate_db')->name('admin_popolatedb');
    Route::get('read_index', 'CertificatoController@read_index')->name('admin_readindex');
    Route::get('popolate_db', 'CertificatoController@popolate_db')->name('admin_popolatedb');

    //Route::get('revokecert/{cert}/{user}', 'CertificatoController@revoke')->name('admin_revokecert');
    Route::get('download/{cert}', 'CertificatoController@download')->name('admin_downloadcert');
    Route::get('revokecert/{cert}', 'CertificatoController@revoke')->name('admin_revokecert');
    Route::get('releasecert/{user}', 'CertificatoController@release')->name('admin_releasecert');

    Route::get('showallusers', 'UserController@index')->name('admin_showallusers');
    Route::get('edituser/{user}', 'UserController@edit')->name('admin_edituser');
    Route::post('updateuser/{user}', 'UserController@update')->name('admin_updateuser');
    Route::get('del/{user}', 'UserController@del')->name('admin_deluser');

    Route::get('showuserfromname/{name}', 'UserController@show_from_name')->name('admin_showuserfromname');
    Route::get('new/{name}', 'UserController@new')->name('admin_newuser');

    ### Rotte personalizzate
    //Route::get('show_calendar', 'DashboardController@show_calendar')->name('show_calendar');
    //Route::post('store_calendar', 'DashboardController@store_calendar')->name('store_calendar');

});


