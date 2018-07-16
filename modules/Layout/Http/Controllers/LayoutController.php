<?php namespace Modules\Layout\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class LayoutController extends Controller {
	
	public function index()
	{
		return view('layout::index');
	}
	
}