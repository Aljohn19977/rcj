<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Category;
use App\SubCategory;
use App\MostFavorites;
use App\Favorites;
use App\Wishlist;
use App\Product;
use Purifier;
use Auth;

class AdminCategoryController extends Controller
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
   /* $category = Category::all();
        return view('admin_ui.view-main-category', compact('category'));*/
        return view('admin_ui.view-main-category');
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
     return view('admin_ui.add-main-category');
    
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
        $this->validate($request,[
                'category_name' => 'required|unique:categories'
            ]);
        $cat = new Category;
        $cat->category_name = Purifier::clean($request->category_name);
        $cat->category_status = Purifier::clean($request->category_status);
        $cat->save();
        return view('admin_ui.add-main-category');
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
      $category = Category::findOrFail($id);
      return view('admin_ui.edit-main-category',compact('category'));  
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
       $this->validate($request,[
                'category_name' => 'required|unique:categories'
            ]);       
        
        $cat = Category::findOrFail($id);
        $cat->category_name = Purifier::clean($request->category_name);
        $cat->category_status = Purifier::clean($request->category_status);
        $cat->save();

        Product::where('category_id','=',$id)->update(['product_status'=>$request->category_status]);
        MostFavorites::where('category_id','=',$id)->update(['product_status'=>$request->category_status]);
        Favorites::where('category_id','=',$id)->update(['product_status'=>$request->category_status]);
        Wishlist::where('category_id','=',$id)->update(['product_status'=>$request->category_status]);  
        SubCategory::where('category_id','=',$id)->update(['subcategory_status'=>$request->category_status]);
           return redirect('category');
          

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

        Product::where('category_id','=',$id)->update(['product_status'=>2]);
        MostFavorites::where('category_id','=',$id)->update(['product_status'=>2]);
        Favorites::where('category_id','=',$id)->update(['product_status'=>2]);
        Wishlist::where('category_id','=',$id)->update(['product_status'=>2]);  
        SubCategory::where('category_id','=',$id)->update(['subcategory_status'=>2]);
        Category::where('id','=',$id)->update(['category_status'=>2]);
        $category=Category::findOrfail($id);
        $category->delete();

       
    }

    public function published($id){
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        Product::where('category_id','=',$id)->update(['product_status'=>1]);
        MostFavorites::where('category_id','=',$id)->update(['product_status'=>1]);
        Favorites::where('category_id','=',$id)->update(['product_status'=>1]);
        Wishlist::where('category_id','=',$id)->update(['product_status'=>1]);  
        SubCategory::where('category_id','=',$id)->update(['subcategory_status'=>1]);
        Category::where('id',$id)->update(['category_status'=>1]);
        return back();
        
    }
    public function unpublished($id){
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
          Product::where('category_id','=',$id)->update(['product_status'=>2]);
          MostFavorites::where('category_id','=',$id)->update(['product_status'=>2]);
          Favorites::where('category_id','=',$id)->update(['product_status'=>2]);
          Wishlist::where('category_id','=',$id)->update(['product_status'=>2]);  
          SubCategory::where('category_id','=',$id)->update(['subcategory_status'=>2]);
          Category::where('id',$id)->update(['category_status'=>2]);
          return back();
    }

    public function apiCategory(){

        $category = Category::all();
        return Datatables::of($category)
            ->addColumn('action',function($category){ 
                 if ($category->category_status == 1){
                return 

                '<a onclick="unpublished('.$category->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">cloud_download</i></a>'.

                '<a href="/category/'.$category->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.

                '<a onclick="deletes('.$category->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}

                else if ($category->category_status == 2){
                return 
                '<a onclick="published('.$category->id.')"  class="btn btn-success waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">cloud_upload</i></a>'.

                '<a href="/category/'.$category->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.

                 '<a onclick="deletes('.$category->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                     })

             ->addColumn('status',function($category){ 
                if ($category->category_status == 1){
                return '<a class="btn btn-success" name="'.$category->category_status.'">Published</a>';}
                else if ($category->category_status == 2){
                return '<a class="btn btn-danger" name="'.$category->category_status.'">UnPublished</a>';}
            })->make(true);

}
}