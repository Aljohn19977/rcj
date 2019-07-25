<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $table = "wishlists";
    protected $fillable = [
   	'product_id',
   	'user_id',
   	'product_qty'
   ]; 
}
