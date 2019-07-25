<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Order;
use App\Product;
use App\PaymentRefund;
use App\Favorites;
use App\MostFavorites;
use App\ShipSocial;
use DB;
use Auth;

class AdminOrderController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        return view('admin_ui.view-orders');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $order = Order::findOrFail($id);
        return view('admin_ui.edit-order',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
         $order = Order::findOrFail($id);
         $order->update($request->all());
           return redirect('/orders');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $products = Order::where('id','=',$id)->first();



        $check = Favorites::where('user_id','=',$products->user_id)->where('product_id','=',$products->product_id)->count();

        if($check == 1){

        }else{
        $products_statuss = Product::where('id','=',$products->product_id)->first();
        $favorites = new Favorites;
        $favorites->user_id = $products->user_id;
        $favorites->product_id = $products->product_id;
        $favorites->product_name = $products->product_name;
        $favorites->product_status = $products_statuss->product_status;
        $favorites->category_id = $products_statuss->category_id;
        $favorites->subcategory_id = $products_statuss->subcategory_id;
        $favorites->save();
       }

        $checks = MostFavorites::where('product_id','=',$products->product_id)->count();

        if($checks == 1){
          DB::table('mf_products')->where('product_id','=',$products->product_id)->increment('counts',1);
        }else{
        $products_status = Product::where('id','=',$products->product_id)->first();
        $favoritess = new MostFavorites;
        $favoritess->product_id = $products->product_id;
        $favoritess->product_name = $products->product_name;
        $favoritess->product_status = $products_statuss->product_status;
        $favoritess->product_price = $products_statuss->product_price;
        $favoritess->category_id = $products_statuss->category_id;
        $favoritess->subcategory_id = $products_statuss->subcategory_id;
        $favoritess->counts = 1;
        $favoritess->save();
       }
               $products->delete();
    }

    public function cancel_order($id){
            if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $ship_cost = ShipSocial::where('item','=','ship_cost')->value('value');
        $order = Order::where('id','=',$id)->value('product_id');
        $order_qty = Order::where('id','=',$id)->value('qty');
        $order_payment_id = Order::where('id','=',$id)->value('payment_id');

        $info_refund = DB::table('orders')->where('id','=',$id)->first();
        if($info_refund->payment==2){
            $refund = new PaymentRefund;
                    $refund->user_id = $info_refund->user_id;
                    $refund->order_id = $id;
                    $refund->payment_id = $info_refund->payment_id;
                    $refund->product_name = $info_refund->product_name;
                    $refund->qty = $info_refund->qty;
                    $refund->product_id = $info_refund->product_id;

                    $order_count =  Order::where('payment_id','=',$order_payment_id)->where('deleted_at', '=' , null)->where('status','<=',3)->get();
                    if(count($order_count)==1){
                        $new_sub = ($info_refund->sub_total + $ship_cost);
                        $refund->sub_total = $new_sub;
                    }else{
                        $refund->sub_total = $info_refund->sub_total;
                    }
                    $refund->payment = $info_refund->payment;
                    $refund->status = 2;
                    $refund->refund_status = 2;
                    Order::Where('id','=',$id)->update(['status'=>4]);
                    $refund->save();
                    return response()->json(['error'=>1]);
        }if($info_refund->payment==1){
            $order_count =  Order::where('payment_id','=',$order_payment_id)->where('deleted_at', '=' , null)->where('status','<=',3)->get();
                Order::Where('id','=',$id)->update(['status'=>4]);
                    if(count($order_count)==1){
                        $new_sub = ($info_refund->sub_total + $ship_cost);
                        DB::table('payment')->where('id','=',$order_payment_id)->decrement('amount',$new_sub);
                        return response()->json(['error'=>2]);
                    }else{
                          DB::table('payment')->where('id','=',$order_payment_id)->decrement('amount',$info_refund->sub_total);
                        return response()->json(['error'=>2]);
                    }
        }
        

        $check = Product::where('id','=',$order)->where('deleted_at', '=' , null)->increment('product_qty',$order_qty);
    }
    public function apiOrders(){
        $order = Order::where('status','<>',4)->get();
        return Datatables::of($order)
            ->addColumn('order_status',function($order){ 
                 if ($order->status == 1){
                return 
                '<a class="btn btn-danger">Pending</a>';}

                else if ($order->status == 2){
                return 
                '<a class="btn btn-warning">On Delivery</a>';}
                else if ($order->status == 3){
                return 
                '<a class="btn btn-success">Delivered</a>';}
                     })

                ->addColumn('action',function($order){ 
                if ($order->status == 3 && $order->payment_status==1){
                return 
                '<a href="/orders/'.$order->id.'" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                '<a onclick="deletes('.$order->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                else if($order->status == 3 && $order->payment_status==2){
                return 
                '<a href="/orders/'.$order->id.'" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                '<a class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;" disabled><i class="material-icons">delete</i></a>';}
                else if ($order->status == 2){
                return 
                '<a href="/orders/'.$order->id.'" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                '<a class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;" disabled><i class="material-icons">delete</i></a>';}
                else if ($order->status == 1){
                return 
                '<a href="/orders/'.$order->id.'" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                  '<a onclick="deletes_cancel('.$order->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                     })

             ->addColumn('payment',function($order){ 
                if ($order->payment == 1){
                return '<a class="btn btn-success" name="'.$order->payment.'">COD</a>';}
                else if ($order->payment == 2){
                return '<a class="btn btn-primary" name="'.$order->payment.'">Paypal</a>';}
            })
             ->addColumn('payment_status',function($order){ 
                if ($order->payment_status == 1){
                return '<a class="btn btn-success">Paid</a>';}
                else if ($order->payment_status == 2){
                return '<a class="btn btn-danger">Unpaid</a>';}
            })->make(true);

}
}
