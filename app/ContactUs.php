<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
      use SoftDeletes;
   public $table = "contact_us";
   protected $fillable = [
   	'email',
    'name',
   	'subject',
   	'message',
   ]; 

   protected $dates=['delete_at'];
}
