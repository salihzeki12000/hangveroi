<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/** User **/
$locale = Request::segment(1);
if (in_array($locale, Config::get('app.available_locales'))) {
	\App::setLocale($locale);
} else {
	$locale = null;
}

Route::get('/', 'HomeController@index');
$pages = DB::table('pages')->get();
foreach($pages as $page) {
	Route::get('/'.$page->slug, 'HomeController@getPages');
}

Route::post('/district_byID', 'HomeController@getDistrict');

/** API **/
Route::group(['prefix' => 'api'], function () {
	Route::post('/category', 'AdminCategoryController@create');
	Route::post('/product-type', 'AdminProductTypeController@create');
	Route::post('/product-manufacturer', 'AdminProductManufacturerController@create');
});

Route::auth();

Route::group(['middleware' => 'auth','prefix' => 'admin'], function () {

	Route::get('/', 'AdminHomeController@index');

	#Orders
	Route::get('orders', 'AdminOrdersController@getOrders');

	#Product
	Route::get('/product', 'AdminProductController@getProduct');
	Route::get('/product/create', 'AdminProductController@postProduct');
	Route::post('/product/create', 'AdminProductController@dopostProduct');
	Route::get('/product/edit/{id}', 'AdminProductController@postProduct');
	Route::post('/product/edit/{id}', 'AdminProductController@dopostProduct');
	Route::post('/product/change', 'AdminProductController@doupdatestatusProduct');
	Route::post('/product/delete', 'AdminProductController@deleteProduct');
	Route::post('/product/image/upload', 'AdminProductController@postImageUpload');
	Route::post('/product/image/get', 'AdminProductController@getImage');
	Route::post('/product/image/delete', 'AdminProductController@deleteImage');

	#Product promotion
	Route::get('/product-promotion', 'AdminProductPromotionController@getProductPromotion');
	Route::get('/product-promotion/create', 'AdminProductPromotionController@postProductPromotion');
	Route::post('/product-promotion/create', 'AdminProductPromotionController@dopostProductPromotion');
	Route::get('/product-promotion/edit/{id}', 'AdminProductPromotionController@postProductPromotion');
	Route::post('/product-promotion/edit/{id}', 'AdminProductPromotionController@dopostProductPromotion');
	Route::post('/product-promotion/change', 'AdminProductPromotionController@doupdatestatusProductPromotion');
	Route::post('/product-promotion/delete', 'AdminProductPromotionController@deleteProductPromotion');

	#Product review
	Route::get('/product-review', 'AdminProductReviewController@getProductReview');
	Route::get('/product-review/create', 'AdminProductReviewController@postProductReview');
	Route::post('/product-review/create', 'AdminProductReviewController@dopostProductReview');
	Route::get('/product-review/edit/{id}', 'AdminProductReviewController@postProductReview');
	Route::post('/product-review/edit/{id}', 'AdminProductReviewController@dopostProductReview');
	Route::post('/product-review/change', 'AdminProductReviewController@doupdatestatusProductReview');
	Route::post('/product-review/delete', 'AdminProductReviewController@deleteProductReview');

	#Product type
	Route::get('/product-type', 'AdminProductTypeController@getProductType');
	Route::get('/product-type/create', 'AdminProductTypeController@postProductType');
	Route::post('/product-type/create', 'AdminProductTypeController@dopostProductType');
	Route::get('/product-type/edit/{id}', 'AdminProductTypeController@postProductType');
	Route::post('/product-type/edit/{id}', 'AdminProductTypeController@dopostProductType');
	Route::post('/product-type/change', 'AdminProductTypeController@doupdatestatusProductType');
	Route::post('/product-type/delete', 'AdminProductTypeController@deleteProductType');

	#Product manufacturer
	Route::get('/product-manufacturer', 'AdminProductManufacturerController@getProductManufacturer');
	Route::get('/product-manufacturer/create', 'AdminProductManufacturerController@postProductManufacturer');
	Route::post('/product-manufacturer/create', 'AdminProductManufacturerController@dopostProductManufacturer');
	Route::get('/product-manufacturer/edit/{id}', 'AdminProductManufacturerController@postProductManufacturer');
	Route::post('/product-manufacturer/edit/{id}', 'AdminProductManufacturerController@dopostProductManufacturer');
	Route::post('/product-manufacturer/change', 'AdminProductManufacturerController@doupdatestatusProductManufacturer');
	Route::post('/product-manufacturer/delete', 'AdminProductManufacturerController@deleteProductManufacturer');

	#News
	Route::get('/news', 'AdminNewsController@getNews');
	Route::get('/news/create', 'AdminNewsController@postNews');
	Route::post('/news/create', 'AdminNewsController@dopostNews');
	Route::get('/news/edit/{id}', 'AdminNewsController@postNews');
	Route::post('/news/edit/{id}', 'AdminNewsController@dopostNews');
	Route::post('/news/change', 'AdminNewsController@doupdatestatusNews');
	Route::post('/news/delete', 'AdminNewsController@deleteNews');
	Route::post('/news/image/upload', 'AdminNewsController@postImageUpload');
	Route::post('/news/image/get', 'AdminNewsController@getImage');
	Route::post('/news/image/delete', 'AdminNewsController@deleteImage');

	#Category news
	Route::get('/category', 'AdminCategoryController@getCategory');
	Route::get('/category/create', 'AdminCategoryController@postCategory');
	Route::post('/category/create', 'AdminCategoryController@dopostCategory');
	Route::get('/category/edit/{id}', 'AdminCategoryController@postCategory');
	Route::post('/category/edit/{id}', 'AdminCategoryController@dopostCategory');
	Route::post('/category/change', 'AdminCategoryController@doupdatestatusCategory');
	Route::post('/category/delete', 'AdminCategoryController@deleteCategory');

	#Category news
	Route::get('/video', 'AdminVideoController@getVideo');
	Route::get('/video/create', 'AdminVideoController@postVideo');
	Route::post('/video/create', 'AdminVideoController@dopostVideo');
	Route::get('/video/edit/{id}', 'AdminVideoController@postVideo');
	Route::post('/video/edit/{id}', 'AdminVideoController@dopostVideo');
	Route::post('/video/change', 'AdminVideoController@doupdatestatusVideo');
	Route::post('/video/delete', 'AdminVideoController@deleteVideo');

	#Page
	Route::get('/page', 'AdminPageController@getPage');
	Route::get('/page/create', 'AdminPageController@postPage');
	Route::post('/page/create', 'AdminPageController@dopostPage');
	Route::get('/page/edit/{id}', 'AdminPageController@postPage');
	Route::post('/page/edit/{id}', 'AdminPageController@dopostPage');
	Route::post('/page/change', 'AdminPageController@doupdatestatusPage');
	Route::post('/page/delete', 'AdminPageController@deletePage');
	// Route::post('/page/image/upload', 'AdminPageController@postImageUpload');
	// Route::post('/page/image/get', 'AdminPageController@getImage');
	// Route::post('/page/image/delete', 'AdminPageController@deleteImage');

	#Image
	Route::get('image', 'AdminGalleryController@getImage');
	Route::post('image/upload', 'AdminGalleryController@postImage');
	Route::post('image/delete', 'AdminGalleryController@deleteImage');
});
