<?php 
namespace App\Models;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use DB;
use Schema;

class Gallery extends Model
{

	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $dates = ['deleted_at'];
	protected $table = 'gallery';

	public static function get_items($name = '', $tag = '', $status = -1, $limit = 0, $where_raw = '', $order_raw = '')
	{
		$db = Gallery::where('name', 'like', '%'.$name.'%');

		if ($tag != '') {
			$db = $db->where('tag', '=', $tag);
		}

		if ($order_raw == '') {
			$db = $db->orderBy('updated_at', 'desc');
		}
		else {
			$db = $db->orderByRaw($order_raw);
		}

		if ($where_raw != '') {
			$db = $db->whereRaw($where_raw);
		}

		if ($status == -1) {
			$db = $db->withTrashed();
		}
		elseif ($status == 1) {
			$db = $db->onlyTrashed();
		}

		if ($limit != 0) {
			return $db->paginate($limit);
		}

		return $db->get();
	}

	public static function deleteFile($id, $remove_in_database = false)
	{
		$result = false;

		if (!is_numeric($id)) {
			return $result;
		}

		$path = Config::get('image.upload_path');
		$photo = Gallery::find($id);

		if (!is_null($photo)) {
			// is file exist?
			if (File::exists($path.$photo->filename)) {

				//URL info
				$info = pathinfo($path.$photo->filename);

				//check if parent dir exist, ex: dailyinfo_20141022-1413969414.1677
				$pattern = '/[a-zA-Z]+\_[0-9]+\-[0-9]+\.[0-9]+/i';
				$dirname = '';

				if(preg_match($pattern, $info['dirname'], $matches))
				{
					foreach($matches as $key => $match)
					{
						$str = explode('/', $match);
						$dirname = $str[count($str) - 1];

						break;
					}
				}
				
				if ($dirname != '') {
					//delete directory
					$result = File::deleteDirectory($path.$dirname);
				}
				else {
					//delete file
					$result = File::delete($path.$photo->filename);
				}

			}

			//delete in database
			if ($remove_in_database) {
				$photo->forceDelete();
			}
		}

		return $result;
	}

	public static function get_parents($id)
	{
		$data = array();

		$tables = DB::select(DB::raw("select table_name from information_schema.tables where table_schema = '".Config::get('database.connections.mysql.database')."'"));

		// dd ($tables);

		foreach ($tables as $tb) {

			$is_skipped = true;
			$db = DB::table($tb->table_name);

			if (Schema::hasColumn($tb->table_name, 'image'))
			{
				$db = $db->orWhere('image', $id);
				$is_skipped = false;
			}

			if (Schema::hasColumn($tb->table_name, 'first_image'))
			{
				$db = $db->orWhere('first_image', $id);
				$is_skipped = false;
			}

			if (Schema::hasColumn($tb->table_name, 'second_image'))
			{
				$db = $db->orWhere('second_image', $id);
				$is_skipped = false;
			}

			if (Schema::hasColumn($tb->table_name, 'third_image'))
			{
				$db = $db->orWhere('third_image', $id);
				$is_skipped = false;
			}

			if (Schema::hasColumn($tb->table_name, 'avatar'))
			{
				$db = $db->orWhere('avatar', $id);
				$is_skipped = false;
			}

			if (Schema::hasColumn($tb->table_name, 'image_author'))
			{
				$db = $db->orWhere('image_author', $id);
				$is_skipped = false;
			}

			if (Schema::hasColumn($tb->table_name, 'main_image'))
			{
				$db = $db->orWhere('main_image', $id);
				$is_skipped = false;
			}

			if (!$is_skipped) {
				
				// var_dump($db->toSql());

				//query table
				$result = $db->get();
				// dd($result);

				//get table rows
				foreach ($result as $item) {
					$data_item = array();

					//var_dump($item);

					$data_item['table_name'] = $tb->table_name;

					$data_item['id'] = $item->id;
					$data_item['name'] = @$item->name;
					$data_item['updated_at'] = @$item->updated_at;
					$data_item['deleted_at'] = @$item->deleted_at;

					//insert to data
					$data[] = $data_item;
				}
			}
		}
		
		return $data;
	}

}