<?php namespace Modules\Home\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class HomeController extends Controller {
	
	public function index()
	{
		$this->data['_header'] =   
		Html::style('plugins/bxslider/jquery.bxslider.min.css').
		Html::script('plugins/bxslider/jquery.bxslider.js');
		
		return view('home::index');
	}
	
}