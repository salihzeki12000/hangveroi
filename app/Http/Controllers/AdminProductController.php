<?php

namespace App\Http\Controllers;

use DB;
use Html;
use Session;
use Auth;
use Illuminate\Http\Request;
use App\Models\Base;
use App\Models\Gallery;
use App\Models\ImageFactory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductType;
use App\Models\ProductManufacturer;
use Redirect;

class AdminProductController extends Controller
{
    public function getProduct()
    {
        $this->data['_header'] =    Html::style('assets/css/plugins/datatables.bootstrap.min.css').
        Html::script('assets/js/plugins/jquery.datatables.min.js').
        Html::script('assets/js/plugins/datatables.bootstrap.min.js').

        Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
        Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');

        $this->data['articleItems'] = Product::withTrashed()->orderBy('updated_at', 'desc')->get();

        $title = trans('product.product');
        $this->data['_title'] = $title;
        $this->data['_nav_title'] = trans('product.product');
        return view('admin.product.list')->with($this->data);
    }

    public function postProduct(Request $request)
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

        Html::script('assets/js/plugins/jquery.datatables.min.js').
        Html::script('assets/js/plugins/datatables.bootstrap.min.js').
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
        $articleItem = Product::withTrashed()->where('id', $id)->first();

        //default value
        $this->data['id']                       = Session::get('d_id', 0);
        $this->data['name']                     = Session::get('d_name', '');
        $this->data['image_thumb']              = Session::get('d_image_thumb', '');
        $this->data['price']                    = Session::get('d_price', '');
        $this->data['descriptions']             = Session::get('d_descriptions', '');
        $this->data['specifications']           = Session::get('d_specifications', '');
        $this->data['units_on_order']           = Session::get('d_units_on_order', 0);
        $this->data['product_type']             = Session::get('d_product_type', 0);
        $this->data['product_manufacturer']     = Session::get('
            d_product_manufacturer', 0);
        $this->data['meta_title']               = Session::get('d_meta_title', '');
        $this->data['meta_keyword']             = Session::get('d_meta_keyword', '');
        $this->data['meta_description']         = Session::get('d_meta_description', '');
        $this->data['is_feature']               = Session::get('d_is_feature', 0);
        $this->data['status']                   = Session::get('d_status', 0);

        if (!is_null($articleItem)) {
            $nav_title = "Modify";

            $this->data['id']                   = $articleItem->id;
            $this->data['name']                 = $articleItem->name;
            $this->data['price']                = $articleItem->price;
            $this->data['descriptions']         = $articleItem->descriptions;
            $this->data['specifications']       = $articleItem->specifications;
            $this->data['units_on_order']       = $articleItem->units_on_order;
            $this->data['product_type']         = $articleItem->product_type;
            $this->data['product_manufacturer'] = $articleItem->product_manufacturer;
            $this->data['meta_title']           = $articleItem->meta_title;
            $this->data['meta_keyword']         = $articleItem->meta_keyword;
            $this->data['meta_description']     = $articleItem->meta_description;
            $this->data['is_feature']           = $articleItem->is_feature;
            $this->data['status']               = $articleItem->trashed();
            if($articleItem->image_thumb != 0)
            {
                if (!empty(Gallery::find($articleItem->image_thumb))) {
                    $this->data['image_thumb']  = Base::get_upload_url($articleItem->getImage->filename);
                }
            }
        }

        $this->data['productImageItems'] = ProductImage::where('product_id', $id)->orderBy('updated_at', 'DESC')->get();
        $this->data['productTypeItems'] = ProductType::withTrashed()->orderBy('name', 'ASC')->get();
        $this->data['productManufacturerItems'] = ProductManufacturer::withTrashed()->orderBy('name', 'ASC')->get();

        $title = trans('product.product') . ' > ' . $nav_title. " | AdminDashboard";
        $this->data['_title'] = $title;
        $this->data['_nav_title'] = trans('product.product') . ' > '.$nav_title;

        return view('admin.product.modify')->with($this->data);
    }

    public function dopostProduct(Request $request)
    {
        $inputs = $request->all();
        $articleItem = Product::withTrashed()->where('id', $inputs['id'])->first();
        if(is_null($articleItem)) {
            $id_product = 0;
            $articleItem = new Product();
        } 

        $id_product = $inputs['id'];
        $articleItem->name = $inputs['name'];
        $articleItem->slug = str_replace(" ", "-", strtolower(cleanVietnamese($inputs['name'])));
        $articleItem->price = $inputs['price'];
        $articleItem->descriptions = $inputs['descriptions'];
        $articleItem->specifications = $inputs['specifications'];
        $articleItem->units_on_order = $inputs['units_on_order'];
        $articleItem->product_type = $inputs['product_type'];
        $articleItem->product_manufacturer = $inputs['product_manufacturer'];
        $articleItem->meta_title = $inputs['meta_title'];
        $articleItem->meta_keyword = $inputs['meta_keyword'];
        $articleItem->meta_description = $inputs['meta_description'];
        $articleItem->is_feature = $inputs['is_feature'];
        if($request->hasFile('image_thumb')) {
            $files = $request->file('image_thumb');
            if (!is_null($files)) {
                $imgf = new ImageFactory();
                $file_url_arr = $imgf->upload(array($files), 'products', 'square');
                $file_url = '';
                if (count($file_url_arr) > 0) {
                    $file_url = $file_url_arr[0];
                }
                if (count($file_url_arr) == 0 || $file_url == '') {
                    $data = array(
                        'message' => 'Invalid image',
                        'd_id' => $articleItem->id,
                        'd_name' => $articleItem->name,
                        'd_price' => $articleItem->price,
                        'd_descriptions' => $articleItem->descriptions,
                        'd_specifications' => $articleItem->specifications,
                        'd_units_on_order' => $articleItem->units_on_order,
                        'd_product_type' => $articleItem->product_type,
                        'd_product_manufacturer' => $articleItem->product_manufacturer,
                        'd_meta_title' => $articleItem->meta_title,
                        'd_meta_keyword' => $articleItem->meta_keyword,
                        'd_meta_description' => $articleItem->meta_description,
                        'd_is_feature' => $articleItem->is_feature,
                        'd_status' => $inputs['status'] == 0 ? "false" : "true",
                        );

                    if ($id_product == 0) {
                        return Redirect::to($request->segment(1)."/".$request->segment(2)."/create")->with($data);
                    } else { 
                        return Redirect::to($request->segment(1)."/".$request->segment(2)."/edit/".$articleItem->id)->with($data);
                    }
                }

                Gallery::deleteFile($articleItem->image_thumb, true);
                $photo = new Gallery();
                $photo->user_id = Auth::user()->id;
                $photo->filename = Base::get_upload_filename($file_url);
                $photo->tag = 'products.image';
                $photo->save();

                $articleItem->image_thumb = $photo->id;

            } 
        } 

        $articleItem->save();

        ProductImage::withTrashed()->where('product_id', 0)->update(['product_id' => $articleItem->id]);

        // update status
        $status = $inputs['status'];
        if ($status == 0) { //published
            //restore item
            $articleItem->restore();
        } elseif ($status == 1) { //pending

            //soft delete
            $articleItem->delete();
        }

        return Redirect::to($request->segment(1).'/'.$request->segment(2));
    }

    public function doupdatestatusProduct(Request $request) 
    {
        $id = $request->id;
        $articleItem = Product::withTrashed()->where('id', $id)->first();

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

    public function deleteProduct(Request $request)
    {
        $id = $request->id;
        $articleItem = Product::withTrashed()->where('id', $id)->first();
        if(!is_null($articleItem)) {
            $productImageItems = ProductImage::withTrashed()->where('product_id', $articleItem['id'])->get();
            if(!is_null($productImageItems)) {
                foreach($productImageItems as $p_item)
                {   
                    Gallery::deleteFile($p_item->image_id, true);
                    $p_item->forceDelete();
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
        $product = Product::withTrashed()->where('id', $id)->first();
        $product_id = 0;
        if(!is_null($product)) {
            $product_id = $product->id;
            $product->save();
        }

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = public_path().'/assets/uploads';


            // Validate the file type
            $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            $filename = $_FILES['Filedata']['name'];
            $filename = 'product_'.date('Ymd').'-'.microtime(true).'.'.strtolower($fileParts['extension']);
            $targetFile = rtrim($targetPath,'/') . '/' . $filename;
            
            if (in_array($fileParts['extension'],$fileTypes)) {

                $photo = new Gallery();
                $photo->user_id  = Auth::user()->id;
                $photo->filename = $filename;
                $photo->tag = 'products.image';
                if($photo->save()) { 
                    $photo_product = new ProductImage();
                    $photo_product->image_id = $photo->id;
                    $photo_product->product_id = $product_id;
                    $photo_product->save();
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
            $imgItems = ProductImage::where('product_id', 0)->get();
        } else { 
            $imgItems = ProductImage::where('product_id', $id)->get();
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
        $imgProduct = ProductImage::withTrashed()->where('id', $id)->get();
        if(!is_null($imgProduct)) {
            foreach($imgProduct as $p_item)
            {   
                Gallery::deleteFile($p_item->image_id, true);
                $p_item->forceDelete();
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
