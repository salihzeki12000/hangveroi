<?php

namespace App\Http\Controllers;

use DB;
use Html;
use Session;
use Auth;
use Redirect;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class AdminProductReviewController extends Controller
{
	public function getProductReview()
	{
		$this->data['_header'] =    Html::style('assets/css/plugins/datatables.bootstrap.min.css').
		Html::script('assets/js/plugins/jquery.datatables.min.js').
		Html::script('assets/js/plugins/datatables.bootstrap.min.js').

		Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
		Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');

		$this->data['articleItems'] = ProductReview::withTrashed()->orderBy('updated_at', 'desc')->get();

		$title = trans('product.product_review');
		$this->data['_title'] = $title;
		$this->data['_nav_title'] = trans('product.product_review');
		return view('admin.product.list_review')->with($this->data);
	}

	public function doupdatestatusProductReview(Request $request) 
	{
		$id = $request->id;
		$articleItem = ProductReview::withTrashed()->where('id', $id)->first();

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

	public function deleteProductReview(Request $request)
	{
		$id = $request->id;
		$articleItem = ProductReview::withTrashed()->where('id', $id)->first();
		if(!is_null($articleItem)) {
			$articleItem->forceDelete();
			return "true";
		}
		return "false";
	}
}
