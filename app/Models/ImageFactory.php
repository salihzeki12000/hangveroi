<?php 
namespace App\Models;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Validator;

class ImageFactory {

    /**
     * Instance of the Imagine package
     * @var Imagine\Gd\Imagine
     */
    protected $imagine;

    /**
     * Type of library used by the service
     * @var string
     */
    protected $library;

    /**
     * Initialize the image service
     * @return void
     */
    public function __construct()
    {
    	if ( ! $this->imagine)
    	{
    		$this->library = Config::get('image.library', 'gd');

            // Now create the instance
    		if ($this->library == 'imagick') $this->imagine = new \Imagine\Imagick\Imagine();
    		elseif ($this->library == 'gmagick') $this->imagine = new \Imagine\Gmagick\Imagine();
    		elseif ($this->library == 'gd')
    			$this->imagine = new \Imagine\Gd\Imagine();
    		else
    			$this->imagine = new \Imagine\Gd\Imagine();
    	}
    }

    /**
	 * Resize an image
	 * @param  string  $url
	 * @param  integer $width
	 * @param  integer $height
	 * @param  boolean $crop
	 * @return string
	 */
    public function resize($url, $width = 100, $height = null, $crop = false, $quality = 80, $suffix = '')
    {
    	if ($url)
    	{
        	//URL info
    		$info = pathinfo($url);

        	//The size
    		if ( ! $height) $height = $width;

        	//Quality
    		$quality = Config::get('image.quality', $quality);


        	//Directories and file names
            $suffix_filename  = $suffix;
            $new_fileName = $info['filename'].'_'.$suffix_filename.'.'.$info['extension'];
            $fileName = $info['basename'];

            $sourceDirPath = Config::get('image.upload_path').$info['dirname'];
            $sourceFilePath = $sourceDirPath . '/' . $fileName;

            $targetDirPath = $sourceDirPath . '/';
            $targetFilePath = $targetDirPath . $new_fileName;
            $targetUrl = asset('assets/uploads/'.$info['dirname'] . '/' . $new_fileName);

        	//Create directory if missing
            try
            {
            	//Create dir if missing
                if (!File::isDirectory($targetDirPath) and $targetDirPath) 
                {
                    @File::makeDirectory($targetDirPath);
                }

            	//Set the size
                $size = new \Imagine\Image\Box($width, $height);

            	//Now the mode
                $mode = $crop ? \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND : \Imagine\Image\ImageInterface::THUMBNAIL_INSET;

                if ( ! File::exists($targetFilePath) or (File::lastModified($targetFilePath) < File::lastModified($sourceFilePath)))
                {
                    $this->imagine->open($sourceFilePath)
                    ->thumbnail($size, $mode)
                    ->save($targetFilePath, array('quality' => $quality));
                }
            }
            catch (\Exception $e)
            {
                Log::error('[IMAGE SERVICE] Failed to resize image "' . $url . '" [' . $e->getMessage() . ']');
            }

            return $targetUrl;
        }
    }

    /**
	* Helper for creating thumbs
	* @param string $url
	* @param integer $width
	* @param integer $height
	* @return string
	*/
	public function thumb($url, $width, $height = null)
	{
		return $this->resize($url, $width, $height, true);
	}

	/**
	 * Upload an image to the public storage
	 * @param  File $file
	 * @return string
	 */
	public function upload($files = array(), $dir = '', $dimension = 'medium', $image_return_type = 'medium', $rules = 'rules')
	{
        $data = array();
        $rules = Config::get('image.'.$rules);
        foreach ($files as $file) {
            if ($file) {
                $validator = Validator::make(array('file'=> $file), $rules);
                // dd($validator);
                //invalid photo
                if (!$validator->passes()) {
                    break;
                }

                // Generate random dir
                $filename = $dir.'_'.date('Ymd').'-'.microtime(true).'.'.strtolower($file->getClientOriginalExtension());
                // Get file info and try to move
                $destination = Config::get('image.upload_path').$dir;
                $path = Config::get('image.upload_dir').$dir.'/'.$filename;
                $uploaded = $file->move($destination, $filename);

                if ($uploaded)
                {
                    if ($dimension != "") {
                        // Get dimensions
                        $dimension_list = Config::get('image.dimensions');
                        $data[] = $this->createDimensions($path, $dimension_list[$dimension], $image_return_type);
                    } else {
                        $data[] = $path;
                    }
                }
            }
        }
        return $data;
    }

	/**
	 * Creates image dimensions based on a configuration
	 * @param  string $url
	 * @param  array  $dimensions
	 * @return void
	 */
	public function createDimensions($url, $dimension, $image_return_type = '')
	{
	    // Get dimmensions and quality
        $width = (int) $dimension[0];
        $height = isset($dimension[1]) ? (int) $dimension[1] : $width;
        $crop = isset($dimension[2]) ? (bool) $dimension[2] : false;
        $quality = isset($dimension[3]) ? (int) $dimension[3] : Config::get('image.quality');

        // Run resizer
        $img = $this->resize($url, $width, $height, $crop, $quality, $image_return_type);        

        //return original file and keep it
        if ($image_return_type == '') {
            return asset('assets/uploads/'.$url);
        }
        //delete original file
        unlink(Config::get('image.upload_path').$url);

        return $img;
    }
}