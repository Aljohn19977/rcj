<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class Category extends Model
{
	use SoftDeletes;
	public $table = "categories";
   protected $fillable = [
   	'category_name',
   	'category_status'
   ]; 

   protected $dates=['delete_at'];


   public function getProducts()
   {
   	return $this->hasMany(Product::class,'category_id','id');
   }
}
