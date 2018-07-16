<?php

Route::group(['middleware' => 'web', 'prefix' => 'layout', 'namespace' => 'Modules\Layout\Http\Controllers'], function()
{
	Route::get('/', 'LayoutController@index');
});