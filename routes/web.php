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

Route::get('/home', 'EnergyProductsController@index')->name('product.index');
Route::get('/products/create', 'EnergyProductsController@create')->name('products.create');
Route::post('/products/create', 'EnergyProductsController@store')->name('products.store');
