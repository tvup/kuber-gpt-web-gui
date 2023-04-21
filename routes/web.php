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

use App\Http\Controllers\ServerAssetController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['locale', 'approved', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/read_index', 'CertificateController@read_index')->name('readindex');
    Route::get('/download_user_cert', 'UserController@downloadUserCert')->name('user.download-user-cert');
});

Route::middleware(['auth', 'locale'])->group(function () {
    Route::get('/approval', 'HomeController@approval')->name('approval');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'locale', 'approved']], function () {

    Route::get('/', 'CertificateController@popolate_db')->name('admin_popolatedb');
    Route::get('read_index', 'CertificateController@read_index')->name('admin_readindex');
    Route::get('popolate_db', 'CertificateController@popolate_db')->name('admin_popolatedb');

    Route::get('download/{certificate}', 'CertificateController@download')->name('admin_downloadcert');
    Route::get('revokecert/{certificate}', 'CertificateController@revoke')->name('admin_revokecert');
    Route::get('releasecert/{user}', 'CertificateController@release')->name('admin_releasecert');

    Route::get('users/show_by_user_name/{user_name}', 'UserController@showByUserName')->name('user.show-by-user-name')->where('user_name', '.*');
    Route::resource('users', UserController::class)->except([]);

    Route::resource('server_assets', ServerAssetController::class);

});
