<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/' , 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Guest')
->name('guest.')
->prefix('guest')
->group(function (){
    // Route::get('homes', 'GuestController@index')->name('homes.index');
    // Route::get('homes/{home}', 'GuestController@show')->name('homes.show');
    // Route::post('messages', 'MessageController@store')->name('messages.store');
    // Route::post('stats/{home_id}', 'StatController@store')->name('stats.store');
    // Route::post('homes/search', 'GuestController@search')->name('homes.search');
});
