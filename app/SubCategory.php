<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class SubCategory extends Model
{
   use SoftDeletes;
   public $table = "subcategories";
   protected $fillable = [
   	'category_id',
   	'category_name',
   	'subcategory_name',
   	'subcategory_status'
   ]; 

   protected $dates=['delete_at'];
   
   public function getSubcat()
   {
   	return $this->hasMany(Product::class,'subcategory_id','id');
   }
}
