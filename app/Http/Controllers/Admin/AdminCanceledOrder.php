<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Order;
use App\Product;
use App\PaymentRefund;
use App\Payment;
use Carbon\Carbon;
use App\ShipSocial;
use Response;
use DB;
use Auth;

class AdminCanceledOrder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        return view('admin_ui.view-cancel-orders');
    }

    /**
     * Show the form for creating a new resource.
     *
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
        return view('admin_ui.edit-cancel-orders',compact('order'));
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
        $now = Carbon::now();
        $check_delete_paypal = PaymentRefund::withTrashed()->where('order_id','=',$id)->get();
        if(count($check_delete_paypal)>=1){
            return response()->json(['error'=>1]);
        }else if(count($check_delete_paypal)==0){
           $delete_PaymentRefund = PaymentRefund::where('order_id','=',$id);
           $delete_PaymentRefund->forceDelete(); 

           $delete_order = Order::findOrfail($id);
           $delete_order->delete(); 
        }
    }

    public function return ($id){
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $order = Order::findOrfail($id);
        $ship_cost = ShipSocial::where('item','=','ship_cost')->value('value');
        $check = Order::withTrashed()->where('payment_id','=',$order->payment_id)->where('status','<=',3)->get();
        $check_pending = Order::where('payment_id','=',$order->payment_id)->where('status','=',1)->get();

        //lahat ng order na may payment na $ID count//
        //lahat ng order na may payment na $ID count yung may bayad///
        //pag pinag minus yan
      

        if(count($check_pending)==0){
            if($order->payment==1){
                if(count($check)==0){
                $total = $order->sub_total + $ship_cost;
                Order::Where('id','=',$id)->update(['status'=>1]);
                Product::where('id','=',$id)->decrement('product_qty',$order->qty);
                Payment::where('id','=',$order->payment_id)->increment('amount',$total);
                 return response()->json(['errors'=>2]);
            }
             }else if($order->payment==2){
                if(count($check)==0){
                Order::Where('id','=',$id)->update(['status'=>1]);
                $refund = PaymentRefund::where('order_id','=',$id)->forceDelete();
                 return response()->json(['errors'=>2]);

            }
                
             }
             return response()->json(['errors'=>1]);
        }
        else if(count($check_pending)>=1){
            if($order->payment==1){

            if(count($check)==0){
                $total = $order->sub_total + $ship_cost;
                Order::Where('id','=',$id)->update(['status'=>1]);
                Product::where('id','=',$id)->decrement('product_qty',$order->qty);
                Payment::where('id','=',$order->payment_id)->increment('amount',$total);
                return response()->json(['errors'=>2]);
            }else{
                $total = $order->sub_total;
                Order::Where('id','=',$id)->update(['status'=>1]);
                Product::where('id','=',$id)->decrement('product_qty',$order->qty);
                Payment::where('id','=',$order->payment_id)->increment('amount',$total);
                return response()->json(['errors'=>2]);
            }
            }else if($order->payment==2){
            if(count($check)==0){
                $total = $order->sub_total + $ship_cost;
                Order::Where('id','=',$id)->update(['status'=>1]);
                Product::where('id','=',$id)->decrement('product_qty',$order->qty);
                $refund = PaymentRefund::where('order_id','=',$id)->forceDelete();
                return response()->json(['errors'=>2]);
            }else{
                $total = $order->sub_total;
                Order::Where('id','=',$id)->update(['status'=>1]);
                Product::where('id','=',$id)->decrement('product_qty',$order->qty);
                $refund = PaymentRefund::where('order_id','=',$id)->forceDelete();
                return response()->json(['errors'=>2]);
            }

            }
            return response()->json(['errors'=>1]);
        }
    }

    public function apiCancelOrders(){
        $order = Order::where('status','=',4)->get();
        return Datatables::of($order)
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
            })
         ->addColumn('action',function($order){ 
                return 
                '<a onclick="returns('.$order->id.')"  class="btn btn-success waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">settings_backup_restore</i></a>'.

                '<a href="/canceled_orders/'.$order->id.'/" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">open_in_browser</i></a>'.

                '<a onclick="deletes('.$order->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';
            })
            ->make(true);

}
}
