<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;
use App\ProductImage;
use App\Address;
use App\Order;
use App\Payment;
use App\ShipSocial;
use Paypalpayment;
use Input;
use Auth;
use redirect;
use Session;
use Purifier;

class CheckoutController extends Controller
{
     public function index()
    {
    	
    	 if(Auth::check()&&Cart::count()>=1){
    	 		$id = Auth::user()->id;
    	 		$address = Address::where('user_id', '=', $id)->count();
    	 		if($address>=1){
    	 			$address = Address::where('user_id', '=', $id)->first();
           			return view ('user_ui.checkout',compact('address'));
    	 		}else{
            return view ('user_ui.checkout-new');
         }
	     }else{

	        return redirect('/login');
	     }

    }

    public function second_address()
    {
      
       if(Auth::check()&&Cart::count()>=1){
          $id = Auth::user()->id;
          $address = Address::where('user_id', '=', $id)->where('number', '=', 2)->count();
          if($address>=1){
            $address = Address::where('user_id', '=', $id)->where('number', '=', 2)->first();
                return view ('user_ui.checkout-secondary',compact('address'));
          }else{
            return view ('user_ui.checkout-new-secondary');
         }
       }else{

          return redirect('/login');
       }

    }

     public function user_address(Request $request){

     		$id = Auth::user()->id;
     		$address = Address::where('user_id', '=', $id)->where('number','=',1)->count();
     		if($address==2||$address==1){
    	 			$address = Address::where('user_id','=',$id)->where('number','=',1)->update([
    	 				'name'=>Purifier::clean($request->name),
    	 				'contact'=>Purifier::clean($request->contact),
    	 				'landline' => Purifier::clean($request->landline),
				        'address1' => Purifier::clean($request->address1),
				        'address2' => Purifier::clean($request->address2),
				        'region' => Purifier::clean($request->region),
				        'city' => Purifier::clean($request->city),
				        'barangay' => Purifier::clean($request->barangay),
				        'landmark' => Purifier::clean($request->landmark),
                'status' => 1,
				        'message' => Purifier::clean($request->message)
    	 				]);
                $address = Address::where('user_id','=',$id)->where('number','=',2)->update([
              'status'=>2,
              ]);
    	 		return redirect('/checkout/orders/payment');
    	 	}else{
		        $address = new Address;
		        $address->user_id = $id;
		        $address->name = Purifier::clean($request->name);
		        $address->contact = Purifier::clean($request->contact);
		        $address->landline = Purifier::clean($request->landline);
		        $address->address1 = Purifier::clean($request->address1);
		        $address->address2 = Purifier::clean($request->address2);
		        $address->region = Purifier::clean($request->region);
		        $address->city = Purifier::clean($request->city);
		        $address->barangay = Purifier::clean($request->barangay);
		        $address->landmark = Purifier::clean($request->landmark);
		        $address->message = Purifier::clean($request->message);
            $address->number = 1;
            $address->status = 1;
		        $address->save();
              $address = Address::where('user_id','=',$id)->where('number','=',2)->update([
              'status'=>2,
              ]);
		        return redirect('/checkout/orders/payment');
    	 	}
    }

public function user_address2(Request $request){

        $id = Auth::user()->id;
        $address = Address::where('user_id', '=', $id)->where('number','=',2)->count();
        if($address==2||$address==1){
            $address = Address::where('user_id','=',$id)->where('number','=',2)->update([
              'name'=>Purifier::clean($request->name),
              'contact'=>Purifier::clean($request->contact),
              'landline' => Purifier::clean($request->landline),
                'address1' => Purifier::clean($request->address1),
                'address2' => Purifier::clean($request->address2),
                'region' => Purifier::clean($request->region),
                'city' => Purifier::clean($request->city),
                'barangay' => Purifier::clean($request->barangay),
                'landmark' => Purifier::clean($request->landmark),
                'message' => Purifier::clean($request->message),
                'status' => 1,
              ]);
              $address = Address::where('user_id','=',$id)->where('number','=',1)->update([
              'status'=>2,
              ]);
          return redirect('/checkout/orders/payment');
        }else{
            $address = new Address;
            $address->user_id = $id;
            $address->name = Purifier::clean($request->name);
            $address->contact = Purifier::clean($request->contact);
            $address->landline = Purifier::clean($request->landline);
            $address->address1 = Purifier::clean($request->address1);
            $address->address2 = Purifier::clean($request->address2);
            $address->region = Purifier::clean($request->region);
            $address->city = Purifier::clean($request->city);
            $address->barangay = Purifier::clean($request->barangay);
            $address->landmark = Purifier::clean($request->landmark);
            $address->message = Purifier::clean($request->message);
            $address->number = 2;
            $address->status = 1;

            $address->save();
               $address = Address::where('user_id','=',$id)->where('number','=',1)->update([
              'status'=>2,
              ]);
            return redirect('/checkout/orders/payment');
        }
    }    


    public function orders_payment(){
    	$productimage = ProductImage::all();
    	$cartItem = Cart::content();
      $cartItems = Cart::content();
      $ship_cost = ShipSocial::where('item','=','ship_cost')->value('value');
    	return view ('user_ui.checkout-order-payment',compact('cartItem','cartItems','productimage','ship_cost'));
    }

    protected function checkout(Request $request){
    	$mode_payment = $request->payment;
    	$id = Auth::user()->id;
    	if($mode_payment=='cod'){
          $address = Address::where('user_id', '=', $id)->where('status', '=', 1)->first();
    			$payments = $request->total;
    			$payment = new Payment;
			    $payment->user_id = $id;
          $payment->name = $address->name;
          $payment->contact = $address->contact;
          $payment->landline = $address->landline;
          $payment->address1 = $address->address1;
          $payment->address2 = $address->address2;
          $payment->region = $address->region;
          $payment->city = $address->city;
          $payment->barangay = $address->barangay;
          $payment->landmark = $address->landmark;
          $payment->message = $address->message;
			    $payment->payment_type = 1;
			    $payment->amount = $payments;
			    $payment->payment_status = 2;
			    $payment->save();

			    $get_payment_id = Payment::latest()->first();
    			
    			$cartItem = Cart::content();
    			foreach($cartItem as $cart){

         Product::where('id','=',$cart->id)->where('deleted_at', '=' , null)->decrement('product_qty',$cart->qty);

      
	    			  $order = new Order;
			        $order->user_id = $id;
			        $order->payment_id = $get_payment_id->id;
			        $order->product_name = $cart->name;
     		    	$order->qty = $cart->qty;
              $order->product_id = $cart->id;
              $order->sub_total = $cart->subtotal;
   			    	$order->payment = 1;
      		  	$order->status = 1;
              $order->payment_status = 2;
			        $order->save();
    			}
            Cart::destroy();
         Session::flash('message', " your order is succesfully created.");
           return redirect('/account');
        }
		else if($mode_payment=='paypal'){
			return redirect('/checkout/paypal');
    	}
    }

    protected function paywithPaypaldone(){
          $address = Address::where('user_id', '=', $id)->where('status', '=', 1)->first();
          $payments = $request->total;
          $payment = new Payment;
          $payment->user_id = $id;
          $payment->name = $address->name;
          $payment->contact = $address->contact;
          $payment->landline = $address->landline;
          $payment->address1 = $address->address1;
          $payment->address2 = $address->address2;
          $payment->region = $address->region;
          $payment->city = $address->city;
          $payment->barangay = $address->barangay;
          $payment->landmark = $address->landmark;
          $payment->message = $address->message;
          $payment->payment_type = 2;
          $payment->amount = $payments;
          $payment->payment_status = 1;
          $payment->save();

          $get_payment_id = Payment::latest()->first();
          
          $cartItem = Cart::content();
          foreach($cartItem as $cart){

         Product::where('id','=',$cart->id)->where('deleted_at', '=' , null)->decrement('product_qty',$cart->qty);

      
              $order = new Order;
              $order->user_id = $id;
              $order->payment_id = $get_payment_id->id;
              $order->product_name = $cart->name;
              $order->qty = $cart->qty;
              $order->product_id = $cart->id;
              $order->sub_total = $cart->subtotal;
              $order->payment = 1;
              $order->status = 1;
              $order->payment_status = 2;
              $order->save();
          }
           Cart::destroy();
           Session::flash('message', " Your order is succesfully created.");
           return redirect('/account');
    }
}
