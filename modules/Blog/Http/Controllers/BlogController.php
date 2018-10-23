<?php namespace Modules\Blog\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class BlogController extends Controller {
	
	public function index()
	{
		return view('blog::index');
	}

	public function detail(Request $request)
	{
		$slug_array = explode("-", $request->segment(2));
		$id = end($slug_array);
		$article = News::find($id);
		$this->data['article'] = $article;
		$this->data['_title'] = $article->name;
		return view('blog::detail')->with($this->data);
	}
	
}