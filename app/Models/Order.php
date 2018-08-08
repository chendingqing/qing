<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function getOrderStatusAttribute($key)
{
    $arr=[0=>'已取消',1=>'代付款',2=>'待发货',3=>'待确认',4=>'完成'];
    return $arr[$this->status];

}

    public $fillable=['user_id','shop_id','sn','province','city','area','detail_address','tel','name','total','status'];


    public function goods()
    {
        return $this->hasMany(OrderGood::class, "order_id");
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, "shop_id");
    }

}
