<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_categories extends Model
{
    public $fillable=['name','type_accumulation','shop_id','description','is_selected'];
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
