<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getUser()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getOrderItems()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }

    public function getNotes()
    {
        return $this->hasMany('App\Models\OrderNote', 'order_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function getTotalOrderByMonth($month)
    {
        return Order::whereBetween('created_at', [date('Y').'-'.$month.'-01', date('Y').'-'.$month.'-31'])->count();
    }
    public function getTotalMoneyByMonth($month)
    {
        $money = 0;
        $orders = Order::whereBetween('created_at', [date('Y').'-'.$month.'-01', date('Y').'-'.$month.'-31'])->get();
        foreach($orders as $order)
        {
            $money += str_replace(',', '', $order->total_price);
        }
        return $money;
    }
}
