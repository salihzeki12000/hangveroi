<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use App\Models\Product;
use App\Models\ProductType;

class Base extends Model {

	protected $table = 'gallery';
	const PRODUCT_BREADCRUMB = 'product';
	const PRODUCT_TYPE_BREADCRUMB = 'news';
	const NEWS_BREADCRUMB = 'news';

	//Insert_item return new ID
	public static function insert_item($model, $data) {
		return $model::create($data);
	}

	//Update_item return 1: true ; return 0: false
	public static function update_item($table, $id, $data) {
		return DB::table($table)
		->where('id', $id)
		->update($data);
	}

	//Delete_item return 1: true ; return 0: false
	public static function delete_item($table, $id) {
		return DB::table($table)
		->where('id', '=', $id)
		->delete();
	}

	//get URL from filename
	public static function get_upload_url($filename, $dir = "/")
	{
		if (strlen($filename) > 0) {
			$prefix = 'http://';
			if (substr_compare($filename, $prefix, 0, 7) != 0) {
				return URL::to('assets/uploads').$dir.$filename;
			}
		}
		// remove 3 lines below when https expire
		$filenameArray = explode(':', $filename);
		if ($filenameArray[0] == 'http') {
			$filename = str_replace("http", "https", $filename);
		}
		return $filename;
	}

	// get filename from URL
	public static function get_upload_filename($url)
	{
		if (strlen($url) > 0) {
			$pattern = '/http[s]*:\/\/[\/a-zA-Z0-9:_\-.]*poste[\/a-zA-Z0-9:_\-.]*uploads\/[0-9a-zA-Z_.\/-]+\.[a-zA-Z]+/i';

			if(preg_match($pattern, $url, $matches))
			{
				foreach($matches as $key => $match)
				{
					$str = explode('/', $match);

					$dir = $str[count($str) - 2];
					$filename = end($str);

					if ($dir == 'uploads') {
						return $filename;
					}

					return $dir.'/'.$filename;
				}
			}
		}

		return $url;
	}

	public static function buildBreadcrumb($type, $id)
	{
		$breadcrumb = "";
		if ($type == self::PRODUCT_BREADCRUMB) {
			$product = Product::find($id);
			if(!empty($product)) {
				$productType = ProductType::find($product->product_type);
				if(!empty($productType)) {
					if ($productType->parent != 0) {
						$productTypeParent = ProductType::find($productType->parent);
						if (!empty($productTypeParent)) {
							$breadcrumb = '
							<li>
								<a href="' . URL::to('product/type/'. $productTypeParent["slug"] .'-'. $productTypeParent["id"]) . '" title="' . $productTypeParent['name'] . '">' . $productTypeParent['name'] .'</a>
							</li>
							<li>
								<a href="' . URL::to('product/type/'. $productType["slug"] .'-'. $productType["id"]) . '" title="' . $productType['name'] . '">' . $productType['name'] .'</a>
							</li>
							<li class="active">' . $product['name'] .' </li>';
						} else {
							$breadcrumb = '<li>
								<a href="' . URL::to('product/type/'. $productType["slug"] .'-'. $productType["id"]) . '" title="' . $productType['name'] . '">' . $productType['name'] .'</a>
							</li>
							<li class="active">' . $product['name'] .' </li>';
						}
					} else {
						$breadcrumb = '
							<li>
								<a href="' . URL::to('product/type/'. $productType["slug"] .'-'. $productType["id"]) . '" title="' . $productType['name'] . '">' . $productType['name'] .'</a>
							</li>
							<li class="active">' . $product['name'] .'
							</li>';	
					}
				}
			}
		}
		if ($type == self::PRODUCT_TYPE_BREADCRUMB) {
			$productType = ProductType::find($id);
			if(!empty($productType)) {
				if ($productType->parent != 0) {
					$productTypeParent = ProductType::find($productType->parent);
					if (!empty($productTypeParent)) {
						$breadcrumb = '
						<li>
							<a href="' . URL::to('product/type/'. $productTypeParent["slug"] .'-'. $productTypeParent["id"]) . '" title="' . $productTypeParent['name'] . '">' . $productTypeParent['name'] .'</a>
						</li>
						<li class="active">' . $productType['name'] .'
						</li>';
					} else {
						$breadcrumb = '<li class="active">' . $productType['name'] .'</li>';
					}
				} else {
					$breadcrumb = '<li class="active">' . $productType['name'] .'</li>';	
				}
			}
		}
		return $breadcrumb;
	}

	public static function get_table_name()
	{
		return $tables = DB::select(DB::raw("select table_name from information_schema.tables where table_schema = '".Config::get('database.connections.mysql.database')."'"));		
	}
}