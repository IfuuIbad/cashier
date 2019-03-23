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

Route::get('/home', 'ItemController@index')->name('home');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/store', 'CartController@store')->name('cart.store');
Route::patch('/cart/{cart}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{cart}', 'CartController@destroy')->name('cart.destroy');

Route::post('/transaction', 'TransactionController@store')->name('transaction.store');
Route::get('/transaction', 'TransactionController@index')->name('transaction.index');
Route::get('/transaction/{transaction}', 'TransactionController@show')->name('transaction.show');
