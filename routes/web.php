<?php

use App\Http\Controllers\OrdersController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/products', 'ProductsController@index')->name('products.index');
    Route::get('/products/create', 'ProductsController@create')->name('products.create');
    Route::post('/products', 'ProductsController@store')->name('products.store');
    Route::get('/products/{id}', 'ProductsController@show')->name('products.show');
    Route::get('/products/{id}/edit', 'ProductsController@edit')->name('products.edit');
    Route::put('/products/{id}', 'ProductsController@update')->name('products.update');
    Route::delete('/products/{id}', 'ProductsController@destroy')->name('products.delete');

    Route::get('/orders', 'OrdersController@index')->name('orders.index');
    Route::get('/orders/create', 'OrdersController@create')->name('orders.create');
    Route::post('/orders', 'OrdersController@store')->name('orders.store');
    Route::get('/orders/{id}', 'OrdersController@show')->name('orders.show');
    Route::get('/orders/{id}/edit', 'OrdersController@edit')->name('orders.edit');
    Route::put('/orders/{id}', 'OrdersController@update')->name('orders.update');
    Route::delete('orders/{id}', 'OrdersController@destroy')->name('orders.delete');

    Route::get('/customers/previous', 'CustomersController@previous');
    Route::post('/customers/previous', 'CustomersController@previousStore');

    Route::get('/customers', 'CustomersController@index')->name('customers.index');
    Route::get('/customers/create', 'CustomersController@create')->name('customers.create');
    Route::post('/customers', 'CustomersController@store')->name('customers.store');
    Route::get('/customers/{id}', 'CustomersController@show')->name('customers.show');
    Route::get('/customers/{id}/edit', 'CustomersController@edit')->name('customers.edit');
    Route::put('/customers/{id}', 'CustomersController@update')->name('customers.update');
    Route::delete('/customers/{id}', 'CustomersController@destroy')->name('customers.delete');

});


