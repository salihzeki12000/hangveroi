<?php

Route::group(['middleware' => 'web', 'prefix' => 'product', 'namespace' => 'Modules\Product\Http\Controllers'], function()
{
	$productTypes = DB::table('product_types')->get();
	foreach($productTypes as $productType) {
		Route::get('/type/'.$productType->slug . '-' . $productType->id, 'ProductController@getProductTypePage');
	}
	Route::get('/type/all', 'ProductController@allProduct');
	Route::get('/', 'ProductController@index');
	Route::get('/{detail}', 'ProductController@detail');
	Route::post('/create-review', 'ProductController@createReview');
	Route::post('/plus-like', 'ProductController@likeReview');
});