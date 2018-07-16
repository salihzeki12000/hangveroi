<?php namespace Modules\Blog\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller {
	
	public function index()
	{
		return view('blog::index');
	}

	public function detail(Request $request)
	{
		echo $request->segment(2);
	}
	
}