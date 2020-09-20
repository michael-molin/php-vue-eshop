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
Route::get('/history/{id}' , 'WelcomeController@history')->name('history');
Route::namespace('Admin')
->name('admin.')
->prefix('admin')
->middleware('auth')
->group(function() {
    Route::resource('products' , 'ProductController');
        // Route::resource('photos' , 'PhotoController');
        // Route::resource('categories' , 'CategoryController');
        // Route::resource('tags' , 'TagController');
        // Route::resource('users' , 'UserController');

// ->group(function (){
//     Route::get('/product', 'ProductController@index')->name('products.index');
//     Route::post('/product', 'ProductController@create')->name('products.create');
//     Route::get('/product/{product_id}', 'ProductController@show')->name('products.show');
//     Route::post('/product/{product_id}', 'ProductController@edit')->name('products.edit');
//     Route::post('/product/{product_id}', 'ProductController@destroy')->name('products.destroy');
});
