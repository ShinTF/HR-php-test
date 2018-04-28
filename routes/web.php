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

Route::get('/', 'MainPageController@index');

Route::get('/test', 'TestController@index');

Route::prefix('orders')->group(function (){
    Route::get('/', 'Orders\OrderController@index')->name('order.show');
    Route::get('/{id}/edit', 'Orders\OrderController@edit')->name('order.edit');
    Route::post('/{id}/update', 'Orders\OrderController@update')->name('order.update');
});

Route::prefix('products')->group(function (){
    Route::get('/', 'Products\ProductController@index')->name('product.list');
    Route::get('/change_price', 'Products\ProductController@ajaxChangePrice')->name('product.list');
});
