<?php

Route::group(['middleware' => 'web', 'prefix' => 'account', 'namespace' => 'Modules\Account\Http\Controllers'], function()
{
	Route::get('/', 'AccountController@index');
	Route::get('/login', 'AccountController@login')->name('loginPage');
	Route::post('/login', 'AccountController@dologin');
	Route::get('/register', 'AccountController@register');
	Route::post('/register', 'AccountController@doregister');

	Route::get('/my-cart', 'AccountController@mycart');
	Route::get('/edit', 'AccountController@editAccount');
	Route::get('/order/history', 'AccountController@managedOrders');

	Route::get('/logout', 'AccountController@logout');
	Route::get('/login-with-facebook', 'AccountController@loginWithFacebook');
	Route::get('/testFB', 'AccountController@doLoginWithFacebook');
	Route::get('/login-with-google', 'AccountController@loginWithGoogle');
});