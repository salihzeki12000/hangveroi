<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getImage()
    {
        return $this->belongsTo('App\Models\Gallery', 'image_thumb', 'id');
    }

    public function getThumb()
    {
        return $this->belongsTo('App\Models\Gallery', 'image_thumb', 'id');
    }
    
}
