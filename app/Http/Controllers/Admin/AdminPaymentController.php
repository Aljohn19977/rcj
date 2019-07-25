<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Model\user\User;
use App\Payment;
use App\PaymentRefund;
use App\Order;
use Auth;

class AdminPaymentController extends Controller
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
        return view('admin_ui.view-payment');
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


    public function record(){
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        return view('admin_ui.view-record-payment');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $payment = Payment::findOrFail($id);
        $user_email = User::where('id','=',$payment->user_id)->value('email');

        $payment = Payment::findOrFail($id);
        return view('admin_ui.edit-payment',compact('payment'))->with('user_email',$user_email);
    }

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
         $payment = Payment::findOrFail($id);
         $get_orders = Order::where('payment_id','=',$id)->get();
         foreach($get_orders as $update){
                $update = Order::where('payment_id','=',$id)->where('status','<>',4)->update(['status'=>$request->status_order,'payment_status'=>$request->status]);
         }
        $payments = Payment::where('id','=',$id)->update(['payment_status'=>$request->status]);
         return redirect('/payment');
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
        $check_amount = Payment::where('id','=',$id)->value('amount');
        if($check_amount==0){
         Payment::where('id','=',$id)->update(['payment_status'=>3]);
         $products=Payment::findOrfail($id);
         $products->delete();
        }else{
          $check_order = Order::where('payment_id','=',$id)->where('status','<=',2)->get();
         $check_delete_paypal = PaymentRefund::where('payment_id','=',$id)->get();
          if(count($check_order)!=0 || count($check_delete_paypal)>=1){
            return response()->json(['error'=>2]);
          }else{
          $products=Payment::findOrfail($id);
          $products->delete();
          return response()->json(['error'=>1]);
          }   
        }
    }

public function apiRecord(){
            $payment = Payment::withTrashed()->where('payment_status','=',1)->where('deleted_at','<>',null)->get();
            return Datatables::of($payment)
             ->addColumn('payment_type',function($payment){ 
                if ($payment->payment_type == 1){
                return '<a class="btn btn-success">COD</a>';}
                else if ($payment->payment_type == 2){
                return '<a class="btn btn-primary">Paypal</a>';}
            })
            ->make(true);
    }


    public function apiPayment(){
            $payment = Payment::all();
            return Datatables::of($payment)
            ->addColumn('payment_status',function($payment){ 
                if ($payment->payment_status == 1){
                return '<a class="btn btn-success">Paid</a>';}
                else if ($payment->payment_status == 2){
                return '<a class="btn btn-danger">Unpaid</a>';}
            })
            ->addColumn('payment_type',function($payment){ 
                if ($payment->payment_type == 1){
                return '<a class="btn btn-success">COD</a>';}
                else if ($payment->payment_type == 2){
                return '<a class="btn btn-primary">Paypal</a>';}
            })
            ->addColumn('action',function($payment){ 
                if($payment->payment_type==1){
                if($payment->amount == 0){
                return 
                '<a class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;" disabled><i class="material-icons">mode_edit</i></a>'.
                '<a onclick="deletes('.$payment->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                if($payment->payment_status == 1){
                return 
                '<a href="/payment/'.$payment->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                '<a onclick="deletes('.$payment->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                else if($payment->payment_status == 2){
                return 
                '<a href="/payment/'.$payment->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                '<a onclick="deletes('.$payment->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                }
                if($payment->payment_type==2){
                if($payment->amount == 0){
                return 
                '<a class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;" disabled><i class="material-icons">mode_edit</i></a>'.
                '<a onclick="deletes('.$payment->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                if($payment->payment_status == 1){
                return 
                '<a href="/payment/'.$payment->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                '<a onclick="deletes('.$payment->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                else if($payment->payment_status == 2){
                return 
                '<a href="/payment/'.$payment->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                '<a onclick="deletes('.$payment->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                }
            })
            ->make(true);
    }

}
