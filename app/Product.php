<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable=['product_name','product_desc','thumnail','gallery','price','quantity' ,'category_id','brand_id'];

    public function Category(){
        return $this->belongsTo("\App\Category");
    }
    public function Brand(){
        return $this->belongsTo("\App\Brand");
    }
    public function Orders(){
        return $this->belongsToMany("\App\Order",'orders_products','product_id','orders_id')->withPivot('qty','price');
    }
    public function getPrice(){
        return number_format($this->price,2,',','.');
    }
}
