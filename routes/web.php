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

//"Outside" - beyond authentication
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['locale'])->group(function () {
    Route::get('/subscription-checkout', 'CashierController@checkoutSubscription')->name('cashier.checkout-subscription');
    Route::get('/sales', 'ProductDisplayController@choose')->name('sales.choose');
    Route::get('/products', 'ProductDisplayController@index')->name('products.index');
});




Auth::routes();

Route::middleware(['locale', 'approved', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/read_index', 'CredentialsController@read_index')->name('readindex');
    Route::get('/download_user_cert', 'UserController@downloadUserCert')->name('user.download-user-cert');
    Route::get('credentials', 'CredentialsController@index')->name('credentials.index');
    Route::post('credentials', 'CredentialsController@index')->name('credentials.edit');
    Route::put('credentials', 'CredentialsController@index')->name('credentials.delete');
});

Route::middleware(['auth', 'locale'])->group(function () {
    Route::get('/approval', 'HomeController@approval')->name('approval');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'locale', 'approved']], function () {

    Route::get('/', 'CredentialsController@index')->name('admin_popolatedb');
    Route::get('read_index', 'CredentialsController@read_index')->name('admin_readindex');


    Route::get('download/{certificate}', 'CredentialsController@download')->name('admin_downloadcert');
    Route::get('revokecert/{certificate}', 'CredentialsController@revoke')->name('admin_revokecert');
    Route::get('releasecert/{user}', 'CredentialsController@release')->name('admin_releasecert');

    Route::get('users/show_by_user_name/{user_name}', 'UserController@showByUserName')->name('user.show-by-user-name')->where('user_name', '.*');
    Route::get('users/{id}/toggle-access', 'UserController@toggleAccess')->name('user.toggle-access');
    Route::resource('users', UserController::class)->except([]);

    Route::resource('server_assets', ServerAssetController::class);

});
