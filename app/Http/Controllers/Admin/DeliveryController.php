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

class DeliveryController extends Controller
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
             if($user_id==1){
                return redirect('/admin-dashboard');
             }
        }
        return view('admin_ui.view-payment-delivery');
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
             if($user_id==1){
                return redirect('/admin-dashboard');
             }
        }
        $payment = Payment::findOrFail($id);
        $user_email = User::where('id','=',$payment->user_id)->value('email');

        $payment = Payment::findOrFail($id);
        return view('admin_ui.edit-payment_delivery',compact('payment'))->with('user_email',$user_email);
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
             if($user_id==1){
                return redirect('/admin-dashboard');
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

    public function apiDelivery(){
            $payment = Payment::where('amount','!=',0)->get();
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
                return 
                '<a href="/delivery/payment/'.$payment->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>';
                })
            ->make(true);
    }
}
