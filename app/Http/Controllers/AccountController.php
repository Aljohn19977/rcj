<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Model\user\User;
use Yajra\Datatables\Datatables;
use App\Order;
use App\PaymentRefund;
use DB;
use App\Product;
use App\Favorites;
use App\ShipSocial;
use App\MostFavorites;
use Purifier;

class AccountController extends Controller
{
    public function index()
    {
         if(Auth::check()){
            $user_id = auth::user()->id;

	        $user=  User::find($user_id);

	        return view('user_ui.account',compact('user'));
        }else{

             return redirect('/login');
        }
    }

    public function update(Request $request, $id){
            // $this->validate($request,[
            //     'name' => 'required|unique:users'
            // ]);

    
            $user = User::where('id','=',$id)->update(['name'=>Purifier::clean($request->name)]);
            return redirect('/account');
    }

    public function destroy_refund($id)
    {

         $Payment=PaymentRefund::findOrfail($id);
         $Payment->delete();
    }

 public function destroy($id)
    {   
        $products=Order::findOrfail($id);
        $products_status=Product::findOrfail($products->product_id)->first();
        $products->delete();

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

    }

    public function cancel_order($id){
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

    public function apiUserOrders(){
        $user_id = auth::user()->id;
        $order = Order::where('user_id','=',$user_id)->get();
        return Datatables::of($order)
                ->addColumn('status',function($order){ 
                 if ($order->status == 1){
                return 
                '<a class="btn btn-warning">Pending</a>';}

                else if ($order->status == 2){
                return 
                '<a class="btn btn-info">On Delivery</a>';}
                else if ($order->status == 3){
                return 
                '<a class="btn btn-success">Delivered</a>';}
                else if ($order->status == 4){
                return 
                '<a class="btn btn-danger">Canceled</a>';}
                })
                 ->addColumn('action',function($order){ 
                if ($order->status == 3 && $order->payment_status==1){
                return 
                '<a onclick="deletes('.$order->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="glyphicon glyphicon-trash"></i></a>';}
                else if($order->status == 3 && $order->payment_status==2){
                return 
                '<a class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;" disabled><i class="glyphicon glyphicon-remove"></i></a>';}
                else if($order->status == 4){
                return                 
                '<a onclick="deletes('.$order->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="glyphicon glyphicon-trash"></i></a>';}
                else if ($order->status == 2){
                return 
                '<a class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;" disabled><i class="glyphicon glyphicon-remove"></i>';}
                else if ($order->status == 1){
                return 
                  '<a onclick="deletes_cancel('.$order->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="glyphicon glyphicon-remove"></i></a>';}
                     })

                 ->addColumn('actions',function($order){ 
                 if ($order->status == 1){
                return

                '<a onclick="deletes('.$order->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="glyphicon glyphicon-remove"></i></a>';}

                else if ($order->status == 2){
                return 

                 '<a class="btn btn-danger" style="float:left;margin-right:5px;margin-bottom:5px;" disabled><i class="glyphicon glyphicon-remove"></i></a>';}

                else if ($order->status == 3){
                return 

                 '<a class="btn btn-danger" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="glyphicon glyphicon-trash"></i></a>';}
                
                else if ($order->status == 4){
                return 

                 '<a class="btn btn-danger" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="glyphicon glyphicon-trash"></i></a>';}
                     })
                ->addColumn('payment',function($order){ 
                if ($order->payment == 1){
                return '<a class="btn btn-success" name="'.$order->payment.'">COD</a>';}
                else if ($order->payment == 2){
                return '<a class="btn btn-info" name="'.$order->payment.'">Paypal</a>';}
            })
                ->make(true);

}
    public function apiUserRefund(){
        $PaymentRefund = PaymentRefund::all();
        return Datatables::of($PaymentRefund)
            ->addColumn('payment',function($PaymentRefund){ 
                if ($PaymentRefund->payment == 1){
                return '<a class="btn btn-success" name="'.$PaymentRefund->payment.'">COD</a>';}
                else if ($PaymentRefund->payment == 2){
                return '<a class="btn btn-info" name="'.$PaymentRefund->payment.'">Paypal</a>';}
                })
            ->addColumn('status1',function($PaymentRefund){ 
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
              ->addColumn('actions',function($PaymentRefund){  
                if ($PaymentRefund->refund_status == 1){
                return 
                  '<a onclick="deletes_refund('.$PaymentRefund->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="glyphicon glyphicon-trash"></a>';}
                else if ($PaymentRefund->refund_status == 2){
                return 
                  '<a class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;" disabled><i class="glyphicon glyphicon-trash"></a>';}
                     })

        ->make(true);

}
}
