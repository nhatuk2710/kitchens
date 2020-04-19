<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $fillable = ['brand_name','image'];
    public function Product(){
        return $this->hasOne("\App\Product");
    }
    public function Products(){
        return $this->hasMany("\App\Product");
    }
}
