<?php

namespace App\Http\Controllers;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\Wishlist;
use App\ContactUs;
use App\Model\user\User;
use App\MostViewed;
use App\MostFavorites;
use App\CarouselImages;
use DB;
use Session;
use Redirect;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $subcategory = SubCategory::all();
        $productimage = CarouselImages::get();
        $product =  DB::table('products')->where('product_status','=',"1")->whereNull('deleted_at')->get();


        return view('user_ui.home',compact('category','subcategory','product','productimage'));
    }

    public function return_json($id)
    {
       $result = product::find($id);
       if(count($result) > 0)
       {
        return response()->json(['qty'=>$result->product_qty]);
       }
    }

    public function products()
    {
       $category = Category::all();
       $wishlist = Wishlist::all();
       $productimage = ProductImage::all();
       $subcategory = SubCategory::all();
       $product =  DB::table('products')->where('product_status','=',"1")->where('deleted_at', '=' , null)->paginate(6);
       return view('user_ui.products',compact('product','category','subcategory','productimage','wishlist'));
    }

    public function products_details($id)
    {

        $products=Product::where('id','=',$id)->first();

        $check = MostViewed::where('product_id','=',$id)->count();

        if($check == 1){
          DB::table('mv_products')->where('product_id','=',$id)->increment('views',1);
        }else{
        $favorites = new MostViewed;
        $favorites->product_id = $id;
        $favorites->product_name = $products->product_name;
        $favorites->product_status = $products->product_status;
        $favorites->product_price = $products->product_price;
        $favorites->category_id = $products->category_id;
        $favorites->subcategory_id = $products->subcategory_id;
        $favorites->views = 1;
        $favorites->save();
       }


       $category = Category::all();
       $productimage = ProductImage::where('product_id','=',$id)->get();
       $subcategory = SubCategory::all();
       $product = product::where('id','=',$id)->where('product_status','=',"1")->whereNull('deleted_at')->with('images')->get();
       //return dd($product);

       return view('user_ui.product_details',compact('product','category','subcategory','productimage'));
    }

    public function products_category(Request $request)
    {
       $cat_name = $request->name;
       $wishlist = Wishlist::all();
       $category = Category::all();
       $productimage = ProductImage::all();
       $subcategory = SubCategory::all();
       $product =  DB::table('products')->where('deleted_at', '=' , null)->where('category_name','=',$cat_name)->where('product_status','=',"1")->paginate(12);
       return view('user_ui.products',compact('product','category','subcategory','productimage','wishlist'));
    }

    public function products_subcategory(Request $request)
    {
       $cat_name = $request->name;
       $wishlist = Wishlist::all();
       $sub_name = $request->sub_name;
       $category = Category::all();
       $productimage = ProductImage::all();
       $subcategory = SubCategory::all();
       $product =  DB::table('products')->where('subcategory_name','=',$sub_name)->where('product_status','=',"1")->where('deleted_at', '=' , null)->paginate(12);
       return view('user_ui.products',compact('product','category','subcategory','productimage','wishlist'));
    }

    public function search(Request $request) {
        $search = $request->search_data;
        $wishlist = Wishlist::all();
        $category = Category::all();
        if ($search == '') {
           return view('user_ui.home',compact('product','category','subcategory','productimage'));
        } else {
            $product = DB::table('products')->where('product_status','=',"1")->where('deleted_at', '=' , null)->where('product_name', 'like', '%' . $search . '%')->paginate(12);
            return view('user_ui.products', compact('product','category','subcategory','productimage','wishlist'));
        }
    }

    public function products_search(Request $request)
    {
       $pro_id = $request->id;
       $category = Category::all();
       $wishlist = Wishlist::all();
       $productimage = ProductImage::all();
       $subcategory = SubCategory::all();
       $product =  DB::table('products')->where('id','=',$pro_id)->where('deleted_at', '=' , null)->where('product_status','=',"1")->paginate(12);
       return view('user_ui.products',compact('product','category','subcategory','productimage','wishlist'));
    }
}
