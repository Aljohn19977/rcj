<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
	public $table = "address";
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
            'number'
   ]; 

   protected $dates=['delete_at'];
}
