<?php namespace Modules\Page\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class PageController extends Controller {
	
	public function index()
	{
		return view('page::index');
	}
	
}