<?php

namespace App\Http\Controllers;

use Auth;
use URL;
use StdClass;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Models\Base;
use App\Models\Gallery;
use App\Models\ImageFactory;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AdminGalleryController extends Controller
{

	public function getImage(Request $request) {
		$user_id = $request->user_id;
		$articleItems = Gallery::where('user_id', $user_id)->orderBy('updated_at', 'desc')->get();
		$string="";
		foreach($articleItems as $item) {
			$string .= '{"url":"'.Base::get_upload_url($item->filename).'", "tag":"'.$item->tag.'", "id":"'. $item->id .'"},';
		}
		return $json_fake = "[".substr($string, 0, -1)."]";
		// return response()->json($json_fake);
	}

	public function postImage() {
		if (!empty($_FILES)) {
			$tempFile = $_FILES['file_name']['tmp_name'];
			$targetPath = public_path().'/assets/uploads';

			// Validate the file type
			$fileTypes = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // File extensions
			$fileParts = pathinfo($_FILES['file_name']['name']);

			$filename = $_FILES['file_name']['name'];
			$filename = $_POST['tag'].'_'.date('Ymd').'-'.microtime(true).'.'.strtolower($fileParts['extension']);
			$targetFile = rtrim($targetPath,'/') . '/' . $filename;
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				$photo = new Gallery();
				$photo->user_id  = Auth::user()->id;
				$photo->filename = $filename;
				$photo->tag = $_POST['tag'].'.image';
				$photo->save();

				if(move_uploaded_file($tempFile,$targetFile)) {
					$response = new StdClass;
					$response->link = Base::get_upload_url($filename);
					echo stripslashes(json_encode($response));
				} 
			} 
		}
	}

	public function deleteImage(Request $request) {
		$id = $request->id;
		// echo stripslashes(json_encode($id));
		$image = Gallery::withTrashed()->where('id', $id)->first();
		if(!is_null($image)) {
			Gallery::deleteFile($image->id, true);
			$image->forceDelete();
			return "true";
		}
		return "false";
	}
}