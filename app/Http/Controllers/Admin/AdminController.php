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
class AdminController extends Controller
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

        $order = Order::where('status','<>',4)->count();
        $stock = DB::table('products')->where('deleted_at','=',null)
        ->select(DB::raw('sum(product_qty) as total'))
        ->value('total');

        $sales_display = DB::table('payment')->where('payment_status','=',1)
        ->where('amount','<>',0)->where('deleted_at','<>',null)
        ->select(DB::raw('sum(amount) as total'))
        ->value('total');

        $product_category = Product::where('product_status','=',1)->select('category_name')->groupBy('category_name')->get('category_name');

         $resultCat = Category::with('getProducts')->get();
        $resultSubCat = SubCategory::with('getSubcat')->get();


        $user_fb = User::where('status','=',1)
        ->where('type','=',2)
        ->count();

        $user_email = User::where('status','=',1)
        ->where('type','=',1)
        ->count();

       // $data = array();
       // foreach($resultCat as $element){
       //          $cat_name = $element->category_name;
       //          $cat_count = $element->getProducts->count();
       //          $data [] = [$cat_name,$cat_count];
       //      foreach($element->getProducts as $product){
       //          foreach($resultSubCat as $scat){
       //              if($scat->id == $product->subcategory_id){
       //                  $subcat_name = $scat->subcategory_name;
       //                  $subcat_count = $scat->getSubcat->count();
       //                  $data2 [] = [$subcat_name,$subcat_count];
       //              }
       //          }        
       //      }
       //  }
       //  $filteredList = array_unique($data2);
       //  return $filteredList;
      // return view('admin_ui.test',compact('resultCat','resultSubCat'));
        return view('admin_ui.dashboard',compact('sales','order','stock','sales_display', 'user_fb','user_email'));

    }


}
