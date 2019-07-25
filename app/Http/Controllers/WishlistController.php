<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Wishlist;
use Auth;
use DB;

class WishlistController extends Controller
{
     public function index()
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             $productimage = ProductImage::all();
             $product = Product::all();
             $wishlist = DB::table('wishlists')->where('user_id','=',$user_id)->where('product_status', '=' , 1)->paginate(5);
             
             return view('wishlist.index',compact('productimage','product','wishlist'));
        }else{

             return redirect('/login');
        }
    }


    public function addItem(Request $request)
    {
        if(Auth::check()){
            $user_id = auth::user()->id;
            $product_id = $request->product_id;
            $product_status = $request->product_status;
            $category_id = $request->category_id;
            $subcategory_id = $request->subcategory_id;

           $wishlist = Wishlist::where('product_id', '=', $product_id)->where('user_id', '=', $user_id)->count();

           if($wishlist=="1")
           {
            return back();
            }

            $wishlist = new Wishlist;
            $wishlist->user_id = $user_id;
            $wishlist->product_id = $product_id;
            $wishlist->product_status = $product_status; 
            $wishlist->category_id = $category_id;
            $wishlist->subcategory_id = $subcategory_id;
            $wishlist->save();
            
            $wishlist_count = Wishlist::where('user_id','=',$user_id = auth::user()->id)->count();

             return response()->json([
                            'product_id'=>$product_id,
                            'user_id'=>$user_id,
                            'wishlist_count'=>$wishlist_count
                            ]);
            }else{

                 return redirect('/login');
            }



    }

    public function destroy($user_id,$pro_id)
    {
        if(Auth::check()){
             $wishlist = Wishlist::where('product_id',$pro_id)->where('user_id',$user_id);
            $wishlist->delete();

            return back();
        }else{

             return redirect('/login');
        }
    }
}
