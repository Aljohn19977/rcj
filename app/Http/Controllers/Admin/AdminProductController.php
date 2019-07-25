<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Validator;
use App\Product;
use App\Category;
use App\SubCategory;
use App\ProductImage;
use Session;
use Redirect;
use Purifier;
use Auth;
use App\MostFavorites;
use App\Favorites;
use App\Wishlist;


class AdminProductController extends Controller
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
        return view('admin_ui.view-product');
    }

    public function back()
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        return back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $category = Category::all();
        $subcategory = SubCategory::all();
        return view('admin_ui.add-product',compact('category','subcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }   
    $count = count($request->file);
    if($count>5){
        Session::flash('message', "Failed to create product you exceeded to the maximum image upload.");
        return Redirect::back();
    }
    $this->validate($request,[
        'product_name' => 'required|unique:products',
        'file' => 'required',
        'file.*' => 'image|mimes:jpeg|max:2048'
    ]);


    $product = new Product;
    $product->product_name = Purifier::clean($request->product_name);
    $product->category_id = Purifier::clean($request->category_id);
    $product->category_name = Purifier::clean($request->category_name);
    $product->subcategory_name = Purifier::clean($request->subcategory_name);
    $product->subcategory_id = Purifier::clean($request->subcategory_id);
    $product->product_status = Purifier::clean($request->product_status);
    $product->product_price = Purifier::clean($request->product_price);
    $product->product_qty = Purifier::clean($request->product_qty);
    $product->product_desc = Purifier::clean($request->product_desc);
    $product->product_sale = Purifier::clean($request->product_sale);
    $product->product_percent = Purifier::clean($request->product_percent);
    $product->save();


    if($request->hasFile('file')){
        foreach ($request->file as $file) {
            $filename =time().$file->getClientOriginalName();
            $file->move('images',$filename);
            $filePath ="images/$filename";
            $product->images()->create(['image_path'=>$filePath]);
        }
    }
     $category = Category::all();
     $subcategory = SubCategory::all();
     return view('admin_ui.add-product',compact('category','subcategory'));
    }

    public function image_upload(Request $request)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
    $qw=$request->product_id;
    $req_file = count($request->file);
    $productimage_count = ProductImage::where('product_id','=',$qw)->count();

    if(($productimage_count+$req_file)>5){
         Session::flash('messages', "Failed to upload you exceeded to the maximum image upload.");
        return Redirect::back(); 
    }
    $product = Product::findOrFail($qw);
    $this->validate($request,[
        'file' => 'required',
        'file.*' => 'image|mimes:jpeg|max:2048'
    ]);


    if($request->hasFile('file')){
        foreach ($request->file as $file) {
            $filename =time().$file->getClientOriginalName();
            $file->move('images',$filename);
            $filePath ="images/$filename";
            $product->images()->create(['image_path'=>$filePath]);
        }
    }
    
    return Redirect::back(); 
    }

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
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $products = Product::findOrFail($id);
        $productimage = ProductImage::where('product_id','=',$id)->get();
        $category = Category::all();
        $subcategory = SubCategory::all();
        return view('admin_ui.edit-product',compact('products','category','subcategory','productimage'));
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
        $products = Product::findOrFail($id); 
        if($request->product_name == $products->product_name){
              Session::flash('message', "Update Failed you inputted old product name.");
              return Redirect::back();
        }
  
        $this->validate($request,[
        'product_name' => 'required|unique:products'
        ]);
        $products->product_name = Purifier::clean($request->product_name);
        $products->category_id = Purifier::clean($request->category_id);
        $products->category_name = Purifier::clean($request->category_name);
        $products->subcategory_name = Purifier::clean($request->subcategory_name);
        $products->subcategory_id = Purifier::clean($request->subcategory_id);
        $products->product_status = Purifier::clean($request->product_status);
        $products->product_price = Purifier::clean($request->product_price);
        $products->product_qty = Purifier::clean($request->product_qty);
        $products->product_desc = Purifier::clean($request->product_desc);
        $products->product_sale = Purifier::clean($request->product_sale);
        $products->product_percent = Purifier::clean($request->product_percent);
        $products->save();

        Category::where('id','=',$request->category_id)->update(['category_status'=>$request->product_status]);
        SubCategory::where('id','=',$request->subcategory_id)->update(['subcategory_status'=>$request->product_status]);

        MostFavorites::where('product_id','=',$id)->update(['product_status'=>$request->product_status]);
        Favorites::where('product_id','=',$id)->update(['product_status'=>$request->product_status]);
        Wishlist::where('product_id','=',$id)->update(['product_status'=>$request->product_status]);
        return redirect('product');


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
        $products=Product::findOrfail($id);
        Product::where('id',$id)->update(['product_status'=>2]);
        MostFavorites::where('product_id','=',$id)->update(['product_status'=>2]);
        Favorites::where('product_id','=',$id)->update(['product_status'=>2]);
        Wishlist::where('product_id','=',$id)->update(['product_status'=>2]);
        $products->delete();
    }

    public function delete_image($id)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $productimage = ProductImage::findOrfail($id);
        $productimage->delete();
    }

    public function published($id){
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $get_cat = Product::where('id','=',$id)->value('category_id'); 
        $get_subcat = Product::where('id','=',$id)->value('subcategory_id'); 
        Category::where('id','=',$get_cat)->update(['category_status'=>1]);
        SubCategory::where('id','=',$get_subcat)->update(['subcategory_status'=>1]);
        Product::where('id',$id)->update(['product_status'=>1]);
        MostFavorites::where('product_id','=',$id)->update(['product_status'=>1]);
        Favorites::where('product_id','=',$id)->update(['product_status'=>1]);
        Wishlist::where('product_id','=',$id)->update(['product_status'=>1]);        
        return back();
        
    }
    public function unpublished($id){
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $get_cat = Product::where('id','=',$id)->value('category_id'); 
        $get_subcat = Product::where('id','=',$id)->value('subcategory_id');
        Category::where('id','=',$get_cat)->update(['category_status'=>2]);
        SubCategory::where('id','=',$get_subcat)->update(['subcategory_status'=>2]);
          Product::where('id',$id)->update(['product_status'=>2]);
          MostFavorites::where('product_id','=',$id)->update(['product_status'=>2]);
          Favorites::where('product_id','=',$id)->update(['product_status'=>2]);
          Wishlist::where('product_id','=',$id)->update(['product_status'=>2]);  
          return back();
    }


    public function apiProducts(){

        $products = Product::all();
        return Datatables::of($products)
            ->addColumn('status',function($products){ 
                if ($products->product_status == 1){
                return '<a class="btn btn-success" name="'.$products->product_status.'">Published</a>';}
                if ($products->product_status == 2){
                return '<a class="btn btn-danger" name="'.$products->product_status.'">UnPublished</a>';}
            })
            ->addColumn('action',function($products){ 
                 if ($products->product_status == 1){
                return 

                '<a onclick="unpublished('.$products->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">cloud_download</i></a>'.

                '<a href="/product/'.$products->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.

                '<a onclick="deletes('.$products->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}

                else if ($products->product_status == 2){
                return 
                '<a onclick="published('.$products->id.')"  class="btn btn-success waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">cloud_upload</i></a>'.

                '<a href="/product/'.$products->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.

                 '<a onclick="deletes('.$products->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                     })->make(true);

}
}
