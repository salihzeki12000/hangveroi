<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Html;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Base;
use App\Models\Gallery;
use App\Models\ImageFactory;
use Auth;
use Redirect;

class AdminSettingController extends Controller
{
	public function bannerSetting()
	{	
		$this->data['_header'] =    Html::style('assets/css/plugins/datatables.bootstrap.min.css').
		Html::script('assets/js/plugins/jquery.datatables.min.js').
		Html::script('assets/js/plugins/datatables.bootstrap.min.js').

		Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
		Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');

		$this->data['articleItems'] = Banner::withTrashed()->orderBy('updated_at', 'desc')->get();

		$this->data['_title'] = 'Banners';
		$this->data['_nav_title'] = 'Banners';
		return view('admin.setting.banners')->with($this->data);
	}

	public function addBanner(Request $request)
	{
		$this->data['_header'] =    Html::style('assets/css/plugins/datatables.bootstrap.min.css').
		Html::script('assets/js/plugins/jquery.datatables.min.js').
		Html::script('assets/js/plugins/datatables.bootstrap.min.js').

		Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
		Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');

		$nav_title = "Create";
		$id = $request->segment(5);
		if (!is_numeric($id)) {
			$id = 0;
		}
		$articleItem = Banner::withTrashed()->where('id', $id)->first();
		//default value
		$this->data['id']       = Session::get('d_id', 0);
		$this->data['url']      = Session::get('d_url', '');
		$this->data['alt']      = Session::get('d_alt', '');
		$this->data['location'] = Session::get('d_location', '');
		$this->data['status']   = Session::get('d_status', 0);
		$this->data['image']   	= Session::get('d_image', 0);

		if (!is_null($articleItem)) {
			$nav_title = "Modify";

			$this->data['id']         = $articleItem->id;
			$this->data['url']        = $articleItem->url;
			$this->data['alt']        = $articleItem->alt;
			$this->data['location']   = $articleItem->location;
			$this->data['status']     = $articleItem->trashed();
			if($articleItem->image != 0)
			{
				if (!empty(Gallery::find($articleItem->image))) {
					$this->data['image']  = Base::get_upload_url($articleItem->getImage->filename);
				}
			}
		}

		$this->data['_title'] = $nav_title . ' Banner';
		$this->data['_nav_title'] = $nav_title . ' Banner';
		return view('admin.setting.banner_add')->with($this->data);
	}

	public function doAddBanner(Request $request)
	{
		$inputs = $request->all();
		$articleItem = Banner::withTrashed()->where('id', $inputs['id'])->first();
		if(is_null($articleItem)) {
			$id_product = 0;
			$articleItem = new Banner();
		} 

		$id_product = $inputs['id'];
		$articleItem->url = $inputs['url'];
		$articleItem->alt = $inputs['alt'];
		$articleItem->location = $inputs['location'];

		if($request->hasFile('image')) {
			$files = $request->file('image');
			if (!is_null($files)) {
				$imgf = new ImageFactory();
				$file_url_arr = $imgf->upload(array($files), 'banners');
				$file_url = '';
				if (count($file_url_arr) > 0) {
					$file_url = $file_url_arr[0];
				}
				if (count($file_url_arr) == 0 || $file_url == '') {
					$data = array(
						'message' => 'Invalid image',
						'd_id' => $articleItem->id,
                        'd_url' => $articleItem->url,
                        'd_alt' => $articleItem->alt,
                        'd_location' => $articleItem->location,
                        'd_status' => $inputs['status'] == 0 ? "false" : "true",
					);
					if ($id_product == 0) {
						return Redirect::to($request->segment(1)."/".$request->segment(2)."/create")->with($data);
					} else { 
						return Redirect::to($request->segment(1)."/".$request->segment(2)."/edit/".$articleItem->id)->with($data);
					}
				}

				Gallery::deleteFile($articleItem->image, true);
                $photo = new Gallery();
                $photo->user_id = Auth::user()->id;
                $photo->filename = Base::get_upload_filename($file_url);
                $photo->tag = 'banners.image';
                $photo->save();

                $articleItem->image = $photo->id;
			}
		}

		$articleItem->save();
		$status = $inputs['status'];
		if ($status == 0) { 
			$articleItem->restore();
		} elseif ($status == 1) { 
			$articleItem->delete();
		}
		return Redirect::to($request->segment(1).'/'.$request->segment(2).'/'.$request->segment(3));
	}

	public function doUpdateStatusBanner(Request $request) 
    {
        $id = $request->id;
        $articleItem = Banner::withTrashed()->where('id', $id)->first();

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

	public function deleteBanner(Request $request)
    {
        $id = $request->id;
        $articleItem = Banner::withTrashed()->where('id', $id)->first();
        if(!is_null($articleItem)) {
            Gallery::deleteFile($articleItem->image, true);
            $articleItem->forceDelete();
            return "true";
        }
        return "false";
    }
}
