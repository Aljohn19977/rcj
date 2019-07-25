<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MostViewed extends Model
{
    public $table = "mv_products";

     public function getProducts()
   {
   	return $this->hasMany(Product::class,'id','product_id');
   }
}
