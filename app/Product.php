<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    public function product(){
    	return $this->belongsTo('App\ProductType','id_type','id'); // belongsTo('link dẫn đến model sản phẩm','khóa ngoại','khóa chính của bảng sản phẩm')
    }
    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_product','id');
    }
}
