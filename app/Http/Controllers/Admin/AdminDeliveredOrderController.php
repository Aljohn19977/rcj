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
use DB;
use Auth;

class AdminDeliveredOrderController extends Controller
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
         return view('admin_ui.view-delivered');
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


    public function apiDelivered(){
        $order = Order::withTrashed()->where('status','=',3)->get();
        return Datatables::of($order)
             ->addColumn('payment',function($order){ 
                if ($order->payment == 1){
                return '<a class="btn btn-success" name="'.$order->payment.'">COD</a>';}
                else if ($order->payment == 2){
                return '<a class="btn btn-primary" name="'.$order->payment.'">Paypal</a>';}
            })
                ->make(true);

}
}
