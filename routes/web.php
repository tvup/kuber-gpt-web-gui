<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    if (app()->isDownForMaintenance()) {
        setcookie('locale', $locale, time() + (60 * 60 * 24 * 30), '/'); // Sætter cookie til at udløbe om 30 dage
    } else {
        Session::put('locale', $locale);
    }

    return redirect()->back();
});

Route::get('/home', function () {
    return redirect('/');
})->name('home');

Route::get('/', function () {
    return view('/landing-pages/appetizer')->with('title',  config('app.name', 'Laravel'));
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/read-more', 'HomeController@readMore')->name('read-more');
Route::get('/about', function () { return view('/landing-pages/about')->with('title',  config('app.name', 'Laravel') );})->name('about');
Route::get('/team', function () { return view('/landing-pages/team')->with('title',  config('app.name', 'Laravel') );})->name('team');
Route::get('/news', function () { return view('/landing-pages/news')->with('title',  config('app.name', 'Laravel') );})->name('news');
Route::get('/its-free', function () { return view('/landing-pages/its-free')->with('title',  config('app.name', 'Laravel') );})->name('its-free');
Route::get('/terms', 'HomeController@terms')->name('terms');
Route::get('/privacy', 'HomeController@privacy')->name('privacy');

Route::get('/contact', 'ContactController@show')->name('contact');;
Route::post('/contact', 'ContactController@mailContactForm');

Route::get('/home2', 'HomeController@index2')->name('home2');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/castle', 'HomeController@castle')->name('castle');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('credentials', 'CredentialsController@index')->name('credentials.index');
    Route::post('/credentials', 'CredentialsController@store')->name('credentials.store');
    Route::put('credentials', 'CredentialsController@update')->name('credentials.update');
    Route::delete('credentials', 'CredentialsController@destroy')->name('credentials.delete');

    Route::resource('run_sets', RunSetController::class);

    Route::post('/launch', 'ConductorController@launch')->name('conductor.launch');
    Route::post('/mega_launch', 'ConductorController@megaLaunch')->name('conductor.mega_launch');
});

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'locale', 'approved']], function () {
    Route::resource('users', UserController::class)->except([]);
    Route::get('users/show_by_user_name/{name}', 'UserController@showByUserName')->name('user.show-by-user-name')->where('name', '.*');
});
