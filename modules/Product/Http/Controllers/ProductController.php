<?php namespace Modules\Product\Http\Controllers;

use Html;
use Pingpong\Modules\Routing\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductImage;
use App\Models\ProductReview;
use App\Models\Base;
use App\Models\Gallery;
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

		$title = empty($articleItem->meta_title) ? $articleItem->name : $articleItem->meta_title;
		$description = empty($articleItem->meta_title) ? $articleItem->description : $articleItem->meta_description;
		$image = '';
		if($articleItem->image_thumb != 0)
		{
			if (!empty(Gallery::find($articleItem->image_thumb))) {
				$image  = Base::get_upload_url($articleItem->getImage->filename);
			}
		}
		$this->data['_title'] = $title;
		$this->data['_description'] = $description;
		$this->data['_image'] = $image;
		return view('product::detail')->with($this->data);
	}

	public static function listProduct($type, array $colNum, $limitProduct, $location)
	{
		$isChild = false;
		$arrayTypes = array();
		if (is_numeric($type)) {
			$productType = ProductType::find($type);
			if (!empty($productType)) {
				if ($productType->parent == 0) {
					$productTypeParents = ProductType::where('parent', $productType->id)->get();
					if (empty($productTypeParents)) {
						$arrayTypes[] =  $productType->id;
					} else {
						$arrayTypes[] =  $productType->id;
						foreach ($productTypeParents as $productTypeParent) {
							$arrayTypes[] = $productTypeParent->id;
						}
					}
					$isChild = true;
				} else {
					$arrayTypes[] = $productType->id;
					$isChild = false;
				}
				$productTypeName = $productType->name;
				$_this->data['productTypeName'] = $productTypeName;
			}
		}
		$_this->data['arrayTypes'] = $arrayTypes;
		$_this->data['location'] = $location;
		$_this->data['isChild'] = $isChild;
		$_this->data['colNum'] = $colNum;
		$_this->data['limitProduct'] = $limitProduct;
		return view('product::listProduct')->with($_this->data);
	}

	public static function listProductByProductType($type)
	{
		$arrayTypes = array();
		$error = false;
		if (is_numeric($type)) {
			$productType = ProductType::find($type);
			if (!empty($productType)) {
				if ($productType->parent == 0) {
					$productTypeParents = ProductType::where('parent', $productType->id)->get();
					if (empty($productTypeParents)) {
						$arrayTypes[] =  $productType->id;
					} else {
						$arrayTypes[] =  $productType->id;
						foreach ($productTypeParents as $productTypeParent) {
							$arrayTypes[] = $productTypeParent->id;
						}
					}
				} else {
					$arrayTypes[] = $productType->id;
				}
				$productTypeName = $productType->name;
				$_this->data['productTypeName'] = $productTypeName;
				$error = false;
			} else {
				$error = true;
			}
		}
		$_this->data['error'] = $error;
		$_this->data['arrayTypes'] = $arrayTypes;
		$_this->data['limitProduct'] = 9;
		return view('product::listProductByType')->with($_this->data);
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

	public function getProductTypePage(Request $request)
	{
		$slug_array = explode("-", $request->segment(3));
		$id = end($slug_array);
		$productType = ProductType::find($id);
		$productTypes = ProductType::where('parent', '0')->get();
		$this->data['productType'] = $productType;
		$this->data['productTypes'] = $productTypes;
		$this->data['_title'] = $productType->name;
		$this->data['_description'] = $productType->name;
		return view('product::productTypePage')->with($this->data);
	}

	public static function getFeatureProductTop()
	{
		$featureProducts = Product::where('is_feature', 1)->orderByRaw('RAND()')->limit(3)->get();
		$_this->data['featureProducts'] = $featureProducts;
		return view('product::listFeatureProduct')->with($_this->data);
	}
}