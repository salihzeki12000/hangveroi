<?php

Route::group(['middleware' => 'web', 'prefix' => 'cart', 'namespace' => 'Modules\Cart\Http\Controllers'], function()
{
	Route::get('/', 'CartController@index');
	Route::get('/destroy', 'CartController@destroyCart');
	Route::post('/addtocart', 'CartController@addCart');
	Route::get('/checkout', 'CartController@doOrder');
	Route::post('/checkout', 'CartController@doOrder');
	Route::get('/checkout/step-{step}', 'CartController@checkout');
	Route::post('/checkout/step-{step}', 'CartController@checkout');
	Route::post('/update-quantity-product', 'CartController@updateQuantityProduct');
});