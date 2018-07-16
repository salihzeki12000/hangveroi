<?php

namespace App\Http\Controllers;

use DB;
use Html;
use Session;
use Auth;
use Redirect;
use Illuminate\Http\Request;
use App\Models\Base;
use App\Models\Gallery;
use App\Models\ImageFactory;
use App\Models\Page;

class AdminPageController extends Controller
{
	public function getPage()
	{
		$this->data['_header'] =    Html::style('assets/css/plugins/datatables.bootstrap.min.css').
		Html::script('assets/js/plugins/jquery.datatables.min.js').
		Html::script('assets/js/plugins/datatables.bootstrap.min.js').

		Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
		Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');

		$this->data['articleItems'] = Page::withTrashed()->orderBy('updated_at', 'desc')->get();

		$title = trans('page.page');
		$this->data['_title'] = $title;
		$this->data['_nav_title'] = trans('page.page');
		return view('admin.page.list')->with($this->data);
	}

	public function postPage(Request $request)
	{
		$this->data['_header'] =    Html::style('assets/css/plugins/select2.min.css').
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
		$articleItem = Page::withTrashed()->where('id', $id)->first();

        //default value
		$this->data['id']                       = Session::get('d_id', 0);
		$this->data['name']                     = Session::get('d_name', '');
		$this->data['slug']                     = Session::get('d_slug', '');
		$this->data['content']             		= Session::get('d_content', '');
		$this->data['metatitle']     			= Session::get('d_metatitle', '');
		$this->data['metakeyword']     			= Session::get('d_metakeyword', '');
		$this->data['metadescription']     		= Session::get('d_metadescription', '');
		$this->data['status']                   = Session::get('d_status', 0);

		if (!is_null($articleItem)) {
			$nav_title = "Modify";

			$this->data['id']                   = $articleItem->id;
			$this->data['name']                 = $articleItem->name;
			$this->data['slug']                 = $articleItem->slug;
			$this->data['content']         		= $articleItem->content;
			$this->data['metatitle']     		= $articleItem->metatitle;
			$this->data['metakeyword']     		= $articleItem->metakeyword;
			$this->data['metadescription']     	= $articleItem->metadescription;
			$this->data['status']               = $articleItem->trashed();
		}

		$title = trans('page.page') . ' > ' . $nav_title. " | AdminDashboard";
		$this->data['_title'] = $title;
		$this->data['_nav_title'] = trans('page.page') . ' > '.$nav_title;

		return view('admin.page.modify')->with($this->data);
	}
	public function dopostPage(Request $request)
	{
		$inputs = $request->all();
		$articleItem = Page::withTrashed()->where('id', $inputs['id'])->first();
		if(is_null($articleItem)) {
			$id_page = 0;
			$articleItem = new Page();
		} 

		$id_page = $inputs['id'];
		$articleItem->name = $inputs['name'];
		$articleItem->slug = str_replace(" ", "-", strtolower($this->cleanVietnamese($inputs['name'])));
		$articleItem->content = $inputs['content'];
		$articleItem->possition = $articleItem->possition == 0 ? DB::table('pages')->max('id') + 1 : $articleItem->possition;
		$articleItem->metatitle = $inputs['metatitle'];
		$articleItem->metakeyword = $inputs['metakeyword'];
		$articleItem->metadescription = $inputs['metadescription'];
		$articleItem->user_id = Auth::user()->id;
		$articleItem->save();

		$status = $inputs['status'];
		if ($status == 0) { 
			$articleItem->restore();
		} elseif ($status == 1) { 
			$articleItem->delete();
		}

		return Redirect::to($request->segment(1).'/'.$request->segment(2));
	}

	function cleanVietnamese($str)
	{
		$unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|ä|å|æ',
			'd'=>'đ|ð',
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
			'i'=>'í|ì|ỉ|ĩ|ị|î|ï',
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Ä|Å|Æ',
			'D'=>'Đ',
			'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë',
			'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï',
			'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
			);
		foreach($unicode as $nonUnicode=>$uni)
		{
			$str = preg_replace("/($uni)/i", $nonUnicode, $str);
		}
		return $str;
	}

	public function doupdatestatusPage(Request $request) 
	{
		$id = $request->id;
		$articleItem = Page::withTrashed()->where('id', $id)->first();

		if (!is_null($articleItem)) {

			if ($articleItem->trashed()) {
				$articleItem->restore();
				return "published";
			} else {
				$articleItem->delete();
				return "pending";
			}
		}

		return "false";
	}

	public function deletePage(Request $request)
	{
		$id = $request->id;
		$articleItem = Page::withTrashed()->where('id', $id)->first();
		if(!is_null($articleItem)) {
			$articleItem->forceDelete();
			return "true";
		}
		return "false";
	}
}






