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
Auth::routes();
Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/checkout/cancel', 'CheckoutController@cancel')->name('checkout.cancel');

/* Paypal */
Route::get('/paypal/{type}', 'PaypalController@index')->name('paypal.initialize');
Route::get('/paypal/success/{type}', 'PaypalController@store')->name('paypal.success');
