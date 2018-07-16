<?php namespace Modules\Product\Http\Controllers;

use Html;
use Pingpong\Modules\Routing\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductImage;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Cart;
use StdClass;

class ProductController extends Controller {
	
	public function index()
	{
		return view('product::index');
	}

	public function detail(Request $request)
	{
		$this->data['_header'] = 
		Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
		Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js').
		
		Html::style('plugins/bootstrap-select/css/bootstrap-select.min.css').
		Html::script('plugins/bootstrap-select/js/bootstrap-select.min.js');
		
		$slug_array = explode("-", $request->segment(2));
		$id = end($slug_array);
		$articleItem = Product::find($id);

		$this->data['productImages'] = ProductImage::where('product_id', $id)->get();

		$productReviews = ProductReview::where('product_id', $id)->get();
		$this->data['productReviews'] = $productReviews; 

		$avg_review = 0;
		foreach($productReviews as $pv_item)
		{
			$avg_review += $pv_item['review'];
		}
		if (count($productReviews) == 0) {
			$numofproductReviews = 1;
		} else {
			$numofproductReviews = count($productReviews);
		}
		$this->data['productReview'] = intval($avg_review/$numofproductReviews);
		$this->data['articleItem'] = $articleItem;

		$title = $articleItem->name;
		$this->data['_title'] = $title;
		$this->data['_description'] = $articleItem->description;
		return view('product::detail')->with($this->data);
	}

	public static function listProduct()
	{
		$_this->data['productTypes'] = ProductType::all();
		return view('product::listProduct')->with($_this->data);
	}

	public function likeReview(Request $request)
	{
		$productReview = ProductReview::find($request->id);
		$productReview->like = $productReview->like + 1;
		$productReview->save();
		return $productReview->like . " likes";
	}

	public function createReview(Request $request) 
	{
		$productReview 				= new ProductReview();
		$productReview->product_id 	= $request->id;
		$productReview->name 		= $request->name;
		$productReview->email 		= $request->email;
		$productReview->content 	= $request->content;
		$productReview->review 		= $request->review;
		$productReview->save();
		$productReview->delete();
		return "ok";
	}

}