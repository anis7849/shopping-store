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
    return redirect()->route('login');
});
Route::resource('categories', Cms\CategoryController::class);
Route::resource('products', Cms\ProductController::class);

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product-list', 'Cms\PublicController@index')->name('product-list');
Route::get('/filter-product-list/{id}', 'Cms\PublicController@getProductsByCategory')->name('product-list');
