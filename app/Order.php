<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
   public $table = "orders";
   protected $fillable = [
 			'name',
            'contact',
            'landline',
            'address1',
            'address2',
            'region',
            'city',
            'barangay',
            'landmark',
            'message',
     		    'product_name',
     		    'qty',
   			    'payment',
      		  'status'

   ]; 

   protected $dates=['delete_at'];
}
