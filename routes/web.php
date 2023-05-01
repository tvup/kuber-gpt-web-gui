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

use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RunSetController;
use App\Http\Controllers\UserController;

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

//"Outside" - beyond authentication
Route::middleware(['locale'])->group(function () {
    Route::get('/landing-pages', function () {
        return redirect('/');
    });

    Route::get('/home', function () {
        return redirect('/');
    })->name('home');

    Route::get('/', function () {
        return view('/landing-pages/appetizer')->with('title',  config('app.name', 'Laravel'));
    })->name('welcome');

    Route::get('/news', function () { return view('/landing-pages/news')->with('title',  config('app.name', 'Laravel') );})->name('news');
    Route::get('/its-free', function () { return view('/landing-pages/its-free')->with('title',  config('app.name', 'Laravel') );})->name('its-free');
    Route::get('/about', function () { return view('/landing-pages/about')->with('title',  config('app.name', 'Laravel') );})->name('about');
    Route::get('/contact', function () { return view('/landing-pages/contact')->with('title',  config('app.name', 'Laravel') );})->name('contact');


    Route::get('/users/create/{product_id}', 'Auth\RegisterController@showRegistrationForm')->name('users.create');
    Route::get('/users/{user_id}/running_port/{running_port}', 'UserController@running_id')->name('landing-pages.choose');
    Route::get('/landing-pages', 'ProductDisplayController@choose')->name('landing-pages.choose');
    Route::get('/subscription-checkout', 'CashierController@checkoutSubscription')->name('cashier.checkout-subscription');
    Route::get('/products', 'ProductDisplayController@index')->name('products.index');
    Route::post('/dosubsribe', 'Auth\RegisterController@receiveSubscriptionIntent')->name('do.subsribe');
    Route::get('/subscribe', 'Auth\RegisterController@subscribeGet')->name('subscribe-get');
    Route::post('/subscribe', 'Auth\RegisterController@subscribe')->name('subscribe');
});





Route::middleware(['locale', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/read_index', 'CredentialsController@read_index')->name('readindex');
    Route::get('/download_user_cert', 'UserController@downloadUserCert')->name('user.download-user-cert');
    Route::get('credentials', 'CredentialsController@index')->name('credentials.index');
    Route::post('/credentials', 'CredentialsController@store')->name('credentials.store');
    Route::put('credentials', 'CredentialsController@update')->name('credentials.update');
    Route::delete('credentials', 'CredentialsController@destroy')->name('credentials.delete');
    Route::resource('run_sets', RunSetController::class);
    Route::post('/launch', 'ConductorController@launch')->name('conductor.launch');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');
    Route::put('/password/reset', [PasswordController::class, 'update'])->name('password.update');
});

Auth::routes();

Route::middleware(['auth', 'locale'])->group(function () {
    Route::get('/approval', 'HomeController@approval')->name('approval');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'locale', 'approved']], function () {

    Route::get('/', 'CredentialsController@index')->name('admin_popolatedb');
    Route::get('read_index', 'CredentialsController@read_index')->name('admin_readindex');


    Route::get('download/{certificate}', 'CredentialsController@download')->name('admin_downloadcert');
    Route::get('revokecert/{certificate}', 'CredentialsController@revoke')->name('admin_revokecert');
    Route::get('releasecert/{user}', 'CredentialsController@release')->name('admin_releasecert');

    Route::get('users/show_by_user_name/{name}', 'UserController@showByUserName')->name('user.show-by-user-name')->where('name', '.*');
    Route::get('users/{id}/toggle-access', 'UserController@toggleAccess')->name('user.toggle-access');
    Route::resource('users', UserController::class)->except([]);



});

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});

Route::get('/event', function () {
    $array = ['ip' => '1.2.3.4']; //data we want to pass
    event(new \App\Events\IpFromConductorEvent($array));

    return 'done';
});
