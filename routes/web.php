<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return redirect('/');
})->name('home');

Route::get('/', function () {
    return view('/landing-pages/appetizer')->with('title',  config('app.name', 'Laravel'));
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/about', function () { return view('/landing-pages/about')->with('title',  config('app.name', 'Laravel') );})->name('about');
Route::get('/news', function () { return view('/landing-pages/news')->with('title',  config('app.name', 'Laravel') );})->name('news');
Route::get('/its-free', function () { return view('/landing-pages/its-free')->with('title',  config('app.name', 'Laravel') );})->name('its-free');
Route::get('/contact', function () { return view('/landing-pages/contact')->with('title',  config('app.name', 'Laravel') );})->name('contact');


Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('credentials', 'CredentialsController@index')->name('credentials.index');
    Route::post('/credentials', 'CredentialsController@store')->name('credentials.store');
    Route::put('credentials', 'CredentialsController@update')->name('credentials.update');
    Route::delete('credentials', 'CredentialsController@destroy')->name('credentials.delete');

    Route::resource('run_sets', RunSetController::class);

    Route::post('/launch', 'ConductorController@launch')->name('conductor.launch');
});

require __DIR__.'/auth.php';

Auth::routes();

