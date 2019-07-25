<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Category;
use App\SubCategory;
use App\Product;
use App\Payment;
use App\Order;
use App\Model\user\User;
use DB;
use Response;
use Auth;
class AdminStatisticsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
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
        $sales = DB::table('payment')->where('payment_status','=',1)
        ->where('amount','<>',0)->where('deleted_at','<>',null)
        ->select(DB::raw('DATE(deleted_at) as date'), DB::raw('sum(amount) as total'))
        ->groupBy(DB::raw('DATE(deleted_at)') )
        ->get();

        $customer_inq = DB::table('contact_us')->where('status','=',1)
        ->where('deleted_at','<>',null)
        ->select(DB::raw('DATE(deleted_at) as date'), DB::raw('count(*) as count'))
        ->groupBy(DB::raw('DATE(deleted_at)') )
        ->get();

        $user_fb = User::where('status','=',1)
        ->where('type','=',2)
        ->count();

        $user_email = User::where('status','=',1)
        ->where('type','=',1)
        ->count();


        $cod = Order::withTrashed()->where('status','=',3)->where('payment_status','=',1)->where('payment','=',1)
        ->count();

        $paypal = Order::withTrashed()->where('status','=',3)->where('payment_status','=',1)->where('payment','=',2)
        ->count();


        return view('admin_ui.statistics',compact('sales','user_fb','user_email','cod','paypal','customer_inq'));

    }


}
