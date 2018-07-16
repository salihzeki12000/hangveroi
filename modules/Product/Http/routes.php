<?php

Route::group(['middleware' => 'web', 'prefix' => 'product', 'namespace' => 'Modules\Product\Http\Controllers'], function()
{
	Route::get('/', 'ProductController@index');
	Route::get('/{detail}', 'ProductController@detail');
	Route::post('/create-review', 'ProductController@createReview');
	Route::post('/plus-like', 'ProductController@likeReview');
});