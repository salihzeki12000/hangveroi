<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
	use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_detail';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function getOrder()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
    
}
