<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = "type_products";
    public function product(){
    	return $this->hasMany('App\Product','id_type','id'); // hasMany('link dẫn đến model sản phẩm','khóa ngoại','khóa chính của bảng loại sản phẩm')
    }
}
