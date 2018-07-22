<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

  public $fillable=['shop_category_id','shops_name','shops_img','shops_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','notice','status'];
  public function shop_category(){
       return $this->belongsTo(ShopCategory::class);
  }


}
