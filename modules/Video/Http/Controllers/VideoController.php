<?php namespace Modules\Video\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\Models\Video;

class VideoController extends Controller {
	
	public function index()
	{
		return view('video::index');
	}

	public static function topVideo()
	{
		$_this->data['articleItem'] = Video::orderBy('id', 'DESC')->first();
		return view('video::top-video')->with($_this->data);
	}
	
}