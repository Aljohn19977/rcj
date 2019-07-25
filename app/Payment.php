<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payment extends Model
{

   use SoftDeletes;
   public $table = "payment";
   protected $fillable = [
   		'user_id',
   		'payment',
   		'amount',
   		'status'
   ]; 

   protected $dates=['delete_at'];
}
