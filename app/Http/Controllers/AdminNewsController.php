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
use App\Models\News;
use App\Models\Category;
use App\Models\NewsImage;

class AdminNewsController extends Controller
{
  public function getNews()
  {
    $this->data['_header'] =    Html::style('assets/css/plugins/datatables.bootstrap.min.css').
    Html::script('assets/js/plugins/jquery.datatables.min.js').
    Html::script('assets/js/plugins/datatables.bootstrap.min.js').

    Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
    Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');

    $this->data['articleItems'] = News::withTrashed()->orderBy('updated_at', 'desc')->get();

    $title = trans('news.news');
    $this->data['_title'] = $title;
    $this->data['_nav_title'] = trans('news.news');
    return view('admin.news.list')->with($this->data);
  }

  public function postNews(Request $request)
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
    $articleItem = News::withTrashed()->where('id', $id)->first();

    //default value
    $this->data['id']                       = Session::get('d_id', 0);
    $this->data['name']                     = Session::get('d_name', '');
    $this->data['image_thumb']              = Session::get('d_image_thumb', '');
    $this->data['content']             		= Session::get('d_content', '');
    $this->data['category_id']     			= Session::get('d_category_id', 0);
    $this->data['metatitle']     			= Session::get('d_metatitle', '');
    $this->data['metakeyword']     			= Session::get('d_metakeyword', '');
    $this->data['metadescription']     		= Session::get('d_metadescription', '');
    $this->data['status']                   = Session::get('d_status', 0);

    if (!is_null($articleItem)) {
      $nav_title = "Modify";

      $this->data['id']                   = $articleItem->id;
      $this->data['name']                 = $articleItem->name;
      $this->data['content']         		= $articleItem->content;
      $this->data['category_id']         	= $articleItem->category_id;
      $this->data['metatitle']     		= $articleItem->metatitle;
      $this->data['metakeyword']     		= $articleItem->metakeyword;
      $this->data['metadescription']     	= $articleItem->metadescription;
      $this->data['status']               = $articleItem->trashed();
      if($articleItem->image_thumb != 0)
      {
        $this->data['image_thumb']      = Base::get_upload_url($articleItem->getImage->filename);
      }
    }

    $this->data['newsImageItems'] = NewsImage::where('news_id', $id)->orderBy('updated_at', 'DESC')->get();
    $this->data['categoryItems'] = Category::withTrashed()->orderBy('name', 'ASC')->get();

    $title = trans('news.news') . ' > ' . $nav_title. " | AdminDashboard";
    $this->data['_title'] = $title;
    $this->data['_nav_title'] = trans('news.news') . ' > '.$nav_title;

    return view('admin.news.modify')->with($this->data);
  }

  public function dopostNews(Request $request)
  {
    $inputs = $request->all();
    $articleItem = News::withTrashed()->where('id', $inputs['id'])->first();
    if(is_null($articleItem)) {
      $id_news = 0;
      $articleItem = new News();
    } 

    $id_news = $inputs['id'];
    $articleItem->name = $inputs['name'];
    $articleItem->slug = str_replace(" ", "-", strtolower($this->cleanVietnamese($inputs['name'])));
    $articleItem->content = $inputs['content'];
    $articleItem->category_id = $inputs['category_id'];
    $articleItem->possition = $articleItem->possition == 0 ? DB::table('news')->max('id') + 1 : $articleItem->possition;
    $articleItem->metatitle = $inputs['metatitle'];
    $articleItem->metakeyword = $inputs['metakeyword'];
    $articleItem->metadescription = $inputs['metadescription'];
    $articleItem->user_id = Auth::user()->id;

    if($request->hasFile('image_thumb')) {
      $file = $request->file('image_thumb');
      if (!is_null($file)) {
        $imgf = new ImageFactory();
        $file_url_arr = $imgf->upload(array($file), 'news');
        $file_url = '';

        if (count($file_url_arr) > 0) {
          $file_url = $file_url_arr[0];
        }

        if (count($file_url_arr) == 0 || $file_url == '') {
          $data = array(
            'message' => 'Invalid image',

            'd_id' => $articleItem->id,
            'd_name' => $articleItem->name,
            'd_content' => $articleItem->descriptions,
            'd_category_id' => $articleItem->category_id,
            'd_metatitle' => $articleItem->metatitle,
            'd_metakeyword' => $articleItem->metakeyword,
            'd_metadescription' => $articleItem->metadescription,
            'd_status' => $inputs['status'] == 0 ? "false" : "true"
            );

          if ($articleItem->id == '') {
            return Redirect::to($request->segment(1)."/".$request->segment(2)."/create")->with($data);
          }
          return Redirect::to($request->segment(1)."/".$request->segment(2)."/edit/".$articleItem->id)->with($data);
        }

        Gallery::deleteFile($articleItem->image_thumb, true);

        $photo = new Gallery();
        $photo->user_id = Auth::user()->id;
        $photo->filename = Base::get_upload_filename($file_url);
        $photo->tag = 'news.image';
        $photo->save();

        $articleItem->image_thumb = $photo->id;
      } 
    } 

    $articleItem->save();

    NewsImage::withTrashed()->where('news_id', 0)->update(['news_id' => $articleItem->id]);

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

  public function doupdatestatusNews(Request $request) 
  {
    $id = $request->id;
    $articleItem = News::withTrashed()->where('id', $id)->first();

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

  public function deleteNews(Request $request)
  {
    $id = $request->id;
    $articleItem = News::withTrashed()->where('id', $id)->first();
    if(!is_null($articleItem)) {
      $newsImageItems = NewsImage::withTrashed()->where('news_id', $articleItem['id'])->get();
      if(!is_null($newsImageItems)) {
        foreach($newsImageItems as $n_item)
        {   
          Gallery::deleteFile($n_item->image_id, true);
          $n_item->forceDelete();
        }
      }
      Gallery::deleteFile($articleItem->image_thumb, true);
      $articleItem->forceDelete();
      return "true";
    }
    return "false";
  }

  public function postImageUpload(Request $request) {
    $id = $request->id;
    if (!is_numeric($id)) {
      $id = 0;
    }
    $news = News::withTrashed()->where('id', $id)->first();
    $news_id = 0;
    if(!is_null($news)) {
      $news_id = $news->id;
      $news->save();
    }

    if (!empty($_FILES)) {
      $tempFile = $_FILES['Filedata']['tmp_name'];
      $targetPath = public_path().'/assets/uploads';
      // Validate the file type
      $fileTypes = array('jpg','jpeg','gif','png'); 
      // File extensions
      $fileParts = pathinfo($_FILES['Filedata']['name']);

      $filename = $_FILES['Filedata']['name'];
      $filename = 'news_'.date('Ymd').'-'.microtime(true).'.'.strtolower($fileParts['extension']);
      $targetFile = rtrim($targetPath,'/') . '/' . $filename;

      if (in_array($fileParts['extension'],$fileTypes)) {

        $photo = new Gallery();
        $photo->user_id  = Auth::user()->id;
        $photo->filename = $filename;
        $photo->tag = 'news.image';
        if($photo->save()) { 
          $photo_news = new NewsImage();
          $photo_news->image_id = $photo->id;
          $photo_news->news_id = $news_id;
          $photo_news->save();
        }

        move_uploaded_file($tempFile,$targetFile);
        echo '1';
      } else {
        echo 'Invalid file type.';
      }
    }
  }

  public function getImage(Request $request){
    $id = $request->id;
    if(!is_numeric($id)) {
      $imgItems = NewsImage::where('news_id', 0)->get();
    } else { 
      $imgItems = NewsImage::where('news_id', $id)->get();
    }
    echo '<table cellspacing="0" cellpadding="0">';
    if($imgItems) {
      foreach($imgItems as $img) {
        echo '<tr id="row_'.$img->id.'">';
        echo '<td style="width:81px;padding-right:10px;">';
        echo '<img width="150" class="gc_thumbnail" src="'.Base::get_upload_url($img->getImage->filename).'"/>';
        echo '</td>';
        echo '<td valign="top" width="430" style="vertical-align:top">';  
        echo '<table width="100%">';
        echo '<tr>';
        echo '<td colspan="2">';
        echo '<a  onclick="return remove_product_image('. $img->id .');" rel="" class="btn" style="float:right; font-size:9px; cursor:pointer">Remove</a>';
        echo '</td>';
        echo '</tr>';
        echo '</table>';
        echo '</td>';
        echo '</tr>';
      }
    }
    echo '</table>';
  }

  public function deleteImage(Request $request) {
    $id = $request->id;
    $imgNews = NewsImage::withTrashed()->where('id', $id)->get();
    if(!is_null($imgNews)) {
      foreach($imgNews as $n_item)
      {   
        Gallery::deleteFile($n_item->image_id, true);
        $n_item->forceDelete();
      }
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
//
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
  //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
  //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
  //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
  //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
  //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
  //
  }
}