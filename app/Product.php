<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
   use SoftDeletes;
   public $table = "products";
   protected $fillable = [
   	'category_id',
      'product_name',
   	'category_name',
   	'subcategory_name',
   	'subcategory_id',
   	'product_image',
      'product_qty',
   	'product_status',
      'product_sale',
      'product_percent',
      'pro_desc'
   ]; 

   protected $dates=['delete_at'];

   public function images(){
         return $this->hasMany(ProductImage::class,'product_id','id');
   }

   public function getImage()
    {
      return $this->hasOne(ProductImage::class,'id','product_id');
    }
}
