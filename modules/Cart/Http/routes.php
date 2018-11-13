<?php

Route::group(['middleware' => 'web', 'prefix' => 'cart', 'namespace' => 'Modules\Cart\Http\Controllers'], function()
{
	Route::get('/', 'CartController@index');
	Route::get('/destroy', 'CartController@destroyCart');
	Route::post('/addtocart', 'CartController@addCart');
	Route::get('/checkout/list', 'CartController@cartList');
	Route::get('/checkout/shipping', 'CartController@shippingStep');
	Route::post('/checkout/shipping/search-info', 'CartController@searchInfo');
	Route::post('/checkout/shipping/calculatorfee', 'CartController@calculatorFee');
	Route::post('/getcheckout', 'CartController@getCheckout');
	// Route::get('/checkout', 'CartController@getCheckout');
	Route::get('/checkout/success', 'CartController@success');
	Route::post('/checkout', 'CartController@doOrder');
	Route::get('/checkout/step-{step}', 'CartController@checkout');
	Route::post('/checkout/step-{step}', 'CartController@checkout');
	Route::post('/update-quantity-product', 'CartController@updateQuantityProduct');
	Route::get('/remove/{rowId}', 'CartController@removeItem');
	Route::post('/remove/{rowId}', 'CartController@removeItem');
});