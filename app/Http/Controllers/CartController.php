<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Gloudemans\Shoppingcart\Facades\Cart;
use Input;
use App\ShipSocial;
use Redirect;
use Session;
class CartController extends Controller
{
    public function index()
    {
    	$productimage = ProductImage::all();
    	$cartItem = Cart::content();
      $cartItems = Cart::content();
      $ship_cost = ShipSocial::where('item','=','ship_cost')->value('value');
      $total = $ship_cost + Cart::subtotal();

    	return view ('cart.index',compact('cartItem','cartItems','productimage','ship_cost','total'));
    }

    public function addItem(request $request)
    {
        $getProduct = product::find($request->product_id);

       $sale_percent = $getProduct->product_percent / 100;
               $price =  $getProduct->product_price * $sale_percent;
               $new_price = $getProduct->product_price - $price;

        $result =  Cart::search(function($cartItem, $rowId) use($request) {
            return $cartItem->id == $request->product_id;
        });

        if(count($result) == 0)
        {
             if($getProduct->product_sale == 1){

                Cart::add(['id' => $request->product_id, 'name' => $getProduct->product_name, 'qty' => $request->requested_qty, 'price' => $new_price ]); 
             $cart_count = Cart::count();
                    return response()->json([
                        'cart_count'=>$cart_count,
             ]);
             }
            
        }
        else
        {
          try {
          $rowId = $result->first()->rowId;
              
          } catch (Exception $e) {
              $rowId = '';
          }

             if(empty($rowId))
             {
                 Cart::add(['id' => $request->product_id, 'name' => $getProduct->product_name, 'qty' => $request->requested_qty, 'price' => $new_price]); 
             }
             else
             {
                $item = Cart::get($rowId);
                if(($request->requested_qty + $item->qty) > $getProduct->product_qty) 
                {
                        $error = 1;
                        $cart_count = Cart::count();
                        return response()->json([
                        'error'=>$error,
                        'cart_count'=>$cart_count,
                        'current_added_qty'=>($request->requested_qty + $item->qty),
                        'item_qty'=>$item->qty

                ]);
        
                }
                else
                {
                    Cart::update($rowId, ($request->requested_qty + $item->qty));  
                }


             }


        }
        
                    $cart_count = Cart::count();
                    return response()->json([
                        'cart_count'=>$cart_count,
                        'current_added_qty'=>($request->requested_qty + $item->qty),
                        'item_qty'=>$item->qty

                        ]);
        
    }

    public function addItemWishlist($id){
      $getProduct = product::find($id);

      $result =  Cart::search(function($cartItem, $rowId) use($id) {
            return $cartItem->id == $id;
        });

     if(count($result) == 0)
        {
             Cart::add(['id' => $id, 'name' => $getProduct->product_name, 'qty' => 1, 'price' => $getProduct->product_price]); 
              Session::flash('message', "Successfully added on your cart.");
              return Redirect::back();
        }
        else
        {
             Session::flash('message', "Already added to your cart.");
              return Redirect::back();
        }
    }

    public function addItemFavorites($id){
      $getProduct = product::find($id);

      $result =  Cart::search(function($cartItem, $rowId) use($id) {
            return $cartItem->id == $id;
        });

     if(count($result) == 0)
        {
             Cart::add(['id' => $id, 'name' => $getProduct->product_name, 'qty' => 1, 'price' => $getProduct->product_price]); 
              Session::flash('message', "Successfully added on your cart.");
              return Redirect::back();
        }
        else
        {
             Session::flash('message', "Already added to your cart.");
              return Redirect::back();
        }
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return back();
    }

    public function update(Request $request, $id)
    {


        if($request->qty<=0){
          Session::flash('message-unit', 'Your inputted value is invalid.');
            return Redirect::back();
        }

        $getProduct = product::find($request->producy_id);
        if($request->qty>$getProduct->product_qty){
            Session::flash('message-errors', 'Update Failed your inputted value exceed to the available stock.');
            return Redirect::back();
        }else{

        Cart::update($id,$request->qty);
            Session::flash('message', "Successfully Updated .");
            return Redirect::back();
       }
    }



}
