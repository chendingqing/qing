<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //设置可以被修改的字段
  public $fillable=['name','password','email','shop_id','status'];
public function shop(){
return $this->belongsTo(Shop::class);
}

}
