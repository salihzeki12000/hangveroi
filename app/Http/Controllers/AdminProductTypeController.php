<?php

namespace App\Http\Controllers;

use Html;
use Session;
use Illuminate\Http\Request;
use App\Models\ProductType;
use Redirect;

class AdminProductTypeController extends Controller
{

	public function getProductType() 
	{
		$this->data['_header'] =    Html::style('assets/css/plugins/datatables.bootstrap.min.css').
		Html::script('assets/js/plugins/jquery.datatables.min.js').
		Html::script('assets/js/plugins/datatables.bootstrap.min.js').

		Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
		Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');

		$this->data['articleItems'] = ProductType::withTrashed()->orderBy('updated_at', 'desc')->get();

		$title = trans('product.producttype');
		$this->data['_title'] = $title;
		$this->data['_nav_title'] = trans('product.producttype');
		return view('admin.product_type.list')->with($this->data);
	}

	public function postProductType(Request $request)
	{
		$this->data['_header'] =    
		Html::style('assets/css/plugins/select2.min.css').
		Html::style('assets/css/plugins/ionrangeslider/ion.rangeSlider.css').
		Html::style('assets/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css').
		Html::style('assets/css/plugins/bootstrap-material-datetimepicker.css').
		Html::style('assets/css/plugins/mediaelementplayer.css').
		Html::style('assets/css/plugins/animate.min.css').
		Html::style('assets/css/plugins/dropzone.css').
		Html::style('plugins/uploadify/uploadify.css').
		Html::style('plugins/froala_editor/css/froala_editor.min.css').

		Html::script('assets/js/plugins/jquery.knob.js').
		Html::script('assets/js/plugins/ion.rangeSlider.min.js').
		Html::script('assets/js/plugins/bootstrap-material-datetimepicker.js').
		Html::script('assets/js/plugins/jquery.mask.min.js').
		Html::script('assets/js/plugins/select2.full.min.js').
		Html::script('assets/js/plugins/nouislider.min.js').
		Html::script('plugins/uploadify/jquery.uploadify.min.js').
		Html::script('plugins/froala_editor/js/froala_editor.min.js').
		Html::script('assets/js/plugins/dropzone.js').
		Html::script('assets/js/plugins/jquery.validate.min.js').

		Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
		Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js').

		Html::style('plugins/bootstrap-select/css/bootstrap-select.min.css').
		Html::script('plugins/bootstrap-select/js/bootstrap-select.min.js');

		$nav_title = "Create";
		$id = $request->segment(4);
		if (!is_numeric($id)) {
			$id = 0;
		}
		$articleItem = ProductType::withTrashed()->where('id', $id)->first();

        //default value
		$this->data['id']                       = Session::get('d_id', 0);
		$this->data['name']                     = Session::get('d_name', '');
		$this->data['status']                   = Session::get('d_status', 0);

		if (!is_null($articleItem)) {
			$nav_title = "Modify";

			$this->data['id']                   = $articleItem->id;
			$this->data['name']                 = $articleItem->name;
			$this->data['status']               = $articleItem->trashed();
		}

		$title = trans('product.producttype') . ' > ' . $nav_title. " | AdminDashboard";
		$this->data['_title'] = $title;
		$this->data['_nav_title'] = trans('product.producttype') . ' > '.$nav_title;

		return view('admin.product_type.modify')->with($this->data);
	}

	public function dopostProductType(Request $request)
	{
		$inputs = $request->all();
		$articleItem = ProductType::withTrashed()->where('id', $inputs['id'])->first();
		if(is_null($articleItem)) {
			$id_product = 0;
			$articleItem = new ProductType();
		} 

		$id_product = $inputs['id'];
		$articleItem->name = $inputs['name'];
		$articleItem->slug = str_replace(" ", "-", strtolower(cleanVietnamese($inputs['name'])));
		$articleItem->save();
		$status = $inputs['status'];
		if ($status == 0) { 
			$articleItem->restore();
		} elseif ($status == 1) { 
			$articleItem->delete();
		}
		return Redirect::to($request->segment(1).'/'.$request->segment(2));
	}

	public function doupdatestatusProductType(Request $request) 
	{
		$id = $request->id;
		$articleItem = ProductType::withTrashed()->where('id', $id)->first();

		if (!is_null($articleItem)) {

			if ($articleItem->trashed()) {

                //restore articleItem
				$articleItem->restore();
				return "published";
			} else {

                //soft delete
				$articleItem->delete();
				return "pending";
			}
		}

		return "false";
	}

	public function deleteProductType(Request $request)
	{
		$id = $request->id;
		$articleItem = ProductType::withTrashed()->where('id', $id)->first();
		if(!is_null($articleItem)) {
			$articleItem->forceDelete();
			return "true";
		}
		return "false";
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		// $items = ProductType::withTrashed()->get();
		// foreach($items as $item) { 
		// 	echo '<option value="'. $item['id'] .'">';
		// 	echo $item['name'];
		// 	echo '<option>';
		// }
	}

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create(Request $request)
	{	
		$producttype = new ProductType();
		$producttype->name = $request->name;
		$producttype->slug = str_replace(" ", "-", strtolower(cleanVietnamese($request->name)));
		if($producttype->save()) {
			$items = ProductType::withTrashed()->orderBy('name', 'ASC')->get();
			foreach ($items as $item) 
			{
				if($item->id == $producttype->id) 
				{
					echo "<option selected='selected' value=".$item->id.">".$item->name."</option>";
				}
				else
				{
					echo "<option value=".$item->id.">".$item->name."</option>";
				}
			}
		} else {
			return "false";
		}
	}
}