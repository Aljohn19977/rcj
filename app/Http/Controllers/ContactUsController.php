<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\Wishlist;
use App\ContactUs;
use App\Model\user\User;
use DB;
use Session;
use Redirect;
use Illuminate\Http\Request;
use Purifier;

class ContactUsController extends Controller
{
    public function contact_us(){
      return view('user_ui.contact_us');
    }

    public function contact_us_submit(Request $request){

      $email = $request->email;
      $check_inq = ContactUs::where('email', '=', $email)->where('status','=',2)->get(); 
      if(count($check_inq)>=3){
      	Session::flash('message', "You exceed to the amount of inquery only 3 is acceptable.");
        return Redirect::back();
      }
      if (User::where('email', '=', $email)->where('status','=',1)->exists()) {
        $user_id_no = User::where('email', '=', $email)->where('status','=',1)->value('id');
        $contact_inq = new ContactUs;
        $contact_inq->name = Purifier::clean($request->name);
        $contact_inq->user_id = Purifier::clean($user_id_no);
        $contact_inq->status = 2;
       	$contact_inq->email = Purifier::clean($request->email);
        $contact_inq->subject = Purifier::clean($request->subject);
        $contact_inq->message = Purifier::clean($request->message);
        $contact_inq->save();

        Session::flash('messages', "Inquery have been send successfully check your email for the response.");
        return Redirect::back();
      }else{
         Session::flash('message', "Invalid Email Address. Please input a registered Email Address.");
        return Redirect::back();
      }
    }
}
