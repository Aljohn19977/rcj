<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Favorites;
use Auth;
use DB;
class UserFavoritesController extends Controller
{
     public function index()
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             $productimage = ProductImage::all();
             $product = Product::all();
             $favorites = DB::table('favorite_product')->where('user_id','=',$user_id)->where('product_status','=',1)->paginate(5);
             
             return view('favorites.index',compact('productimage','product','favorites'));
        }else{

             return redirect('/login');
        }
    }

    public function destroy($user_id,$pro_id)
    {
        if(Auth::check()){
             $favorites = Favorites::where('product_id',$pro_id)->where('user_id',$user_id);
            $favorites->delete();

            return back();
        }else{

             return redirect('/login');
        }
    }
}
