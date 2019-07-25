<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Order;
use App\Payment;
use App\Product;
use App\PaymentRefund;
use App\Model\user\User;
use App\Mail\refundmailer;
use Carbon\Carbon;
use Mail;
use DB;
use Auth;


class AdminRefundController extends Controller
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
         return view('admin_ui.view-refund');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refund_update(Request $request)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $now = Carbon::now();
        $amount = $request->amount;
        $id = $request->order_id;
        $check_ref_status =  DB::table('paymentrefund')->where('order_id','=',$request->order_id)->value('refund_status');
        if ($request->status==1){
            $check_ref_status =  DB::table('paymentrefund')->where('order_id','=',$request->order_id)->value('refund_status');
            if($check_ref_status==1){
                return redirect('/refund'); 
            }else if($check_ref_status==2){
                $user_email =  DB::table('payment')->where('id','=',$request->payment_id)->decrement('amount',$amount);

                DB::table('paymentRefund')->where('order_id','=',$request->order_id)->update(['refund_status'=>$request->status]);
                DB::table('orders')->where('id','=',$request->order_id)->update(['status'=>4,'deleted_at'=>$now]);
                 return redirect('/refund');
            }
        }else if($request->status==2){
              $check_ref_status =  DB::table('paymentrefund')->where('order_id','=',$request->order_id)->value('refund_status');
            if($check_ref_status==1){
                
                $user_email =  DB::table('payment')->where('id','=',$request->payment_id)->increment('amount',$amount);

                DB::table('paymentRefund')->where('order_id','=',$request->order_id)->update(['refund_status'=>$request->status]);

                DB::table('orders')->where('id','=',$request->order_id)->update(['status'=>4]);

                $eco = Order::withTrashed()->where('id','=',$request->order_id);
                $eco->restore();

             $order = Order::findOrfail($id);
             $check_pending = Order::where('payment_id','=',$order->payment_id)->where('status','<>',4)->get();
            
            if(count($check_pending)>=1){
             return redirect('/refund');
            }else if(count($check_pending)==0){
             return redirect('/refund');
            }


                  return redirect('/refund');

            }else if($check_ref_status==2){
                 return redirect('/refund');
            }
        }

             //$check_ref_status =  DB::table('paymentrefund')->where('order_id','=',$request->order_id)->value('refund_status');
            //if($check_ref_status==1){
            //}else if($check_ref_status==2){
              //   $user_email =  DB::table('payment')->where('id','=',$request->payment_id)->decrement('amount',$amount);
           //      PaymentRefund::where('order_id','=',$request->order_id)->update([
              ///              'refund_status'=>$request->status]);
         //        return ('refunded');               
           // }else if($check_ref_status==3){
          //      return('walang pake');//


    }

    public function refund_emailer(Request $request)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
       Mail::send(new refundmailer());
       return ('sent');

    }

    public function edit($id)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $paymentrefund =  DB::table('paymentRefund')->where('id','=',$id)->first();
        $user_email = User::where('id','=',$paymentrefund->user_id)->value('email');
        $id_pay = $paymentrefund->payment_id;
        $user_info = Payment::where('id','=',$id_pay)->first();
        return view('admin_ui.edit-refund',compact('paymentrefund','user_info'))->with('user_email',$user_email);
    }

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
         $Payment=PaymentRefund::findOrfail($id);
         $Payment->delete();
    }

    public function record(){
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        return view('admin_ui.view-refund-record');
    }

    public function apiRefund(){
        $PaymentRefund = PaymentRefund::all();
        return Datatables::of($PaymentRefund)
            ->addColumn('payment',function($PaymentRefund){ 
                 if ($PaymentRefund->payment == 1){
                return 
                '<a class="btn btn-success">COD</a>';}

                else if ($PaymentRefund->payment == 2){
                return 
                '<a class="btn btn-primary">Paypal</a>';}
                })
            ->addColumn('status',function($PaymentRefund){ 
                 if ($PaymentRefund->status == 1){
                return 
                '<a class="btn btn-danger">Returned Order</a>';}

                else if ($PaymentRefund->status == 2){
                return 
                '<a class="btn btn-danger">Canceled Order</a>';}
                })
             ->addColumn('refund_status',function($PaymentRefund){ 
                 if ($PaymentRefund->refund_status == 1){
                return 
                '<a class="btn btn-success">Refunded</a>';}

                else if ($PaymentRefund->refund_status == 2){
                return 
                '<a class="btn btn-danger">Unrefunded</a>';}
                })
              ->addColumn('action',function($PaymentRefund){  
                if ($PaymentRefund->refund_status == 1){
                return 
                 '<a href="/refund/'.$PaymentRefund->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                  '<a onclick="deletes_cancel('.$PaymentRefund->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                else if ($PaymentRefund->refund_status == 2){
                return 
                 '<a href="/refund/'.$PaymentRefund->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.
                  '<a class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;" disabled><i class="material-icons">delete</i></a>';}
                     })

        ->make(true);

}

    public function apiRecord(){
        $PaymentRefund = PaymentRefund::withTrashed()->where('refund_status','=',1)->get();
        return Datatables::of($PaymentRefund)
            ->addColumn('payment',function($PaymentRefund){ 
                 if ($PaymentRefund->payment == 1){
                return 
                '<a class="btn btn-success">COD</a>';}

                else if ($PaymentRefund->payment == 2){
                return 
                '<a class="btn btn-primary">Paypal</a>';}
                })
            ->addColumn('status',function($PaymentRefund){ 
                 if ($PaymentRefund->status == 1){
                return 
                '<a class="btn btn-danger">Returned Order</a>';}

                else if ($PaymentRefund->status == 2){
                return 
                '<a class="btn btn-danger">Canceled Order</a>';}
                })

        ->make(true);

}
}
