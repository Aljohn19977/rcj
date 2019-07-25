<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Category;
use App\SubCategory;
use App\Product;
use Purifier;
use Auth;
use App\MostFavorites;
use App\Favorites;
use App\Wishlist;

class AdminSubCategoryController extends Controller
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
        $category = Category::all();
        return view('admin_ui.view-sub-category',compact('category'));
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
        return view('admin_ui.add-sub-category',compact('category'));
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
            'subcategory_name' => 'required|unique:subcategories'
        ]);
         $category = Category::all();
         $sub = new SubCategory;
         $sub->subcategory_name = Purifier::clean($request->subcategory_name);
         $sub->subcategory_status = $request->subcategory_status;
         $sub->category_id = $request->category_id;
         $sub->category_name = Purifier::clean($request->category_name);
         $sub->save();
         return view('admin_ui.add-sub-category',compact('category'));
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
         $category = Category::all();
         $subcategory = SubCategory::findOrFail($id);
        return view('admin_ui.edit-sub-category',compact('subcategory','category'));
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
            'subcategory_name' => 'required|unique:subcategories'
        ]);
         $sub = SubCategory::findOrFail($id);
         $sub->subcategory_name = Purifier::clean($request->subcategory_name);
         $sub->subcategory_status = $request->subcategory_status;
         $sub->category_id = $request->category_id;
         $sub->category_name = Purifier::clean($request->category_name);
         $sub->save();

        Product::where('subcategory_id','=',$id)->update(['product_status'=>$request->subcategory_status]);
        MostFavorites::where('subcategory_id','=',$id)->update(['product_status'=>$request->subcategory_status]);
        Favorites::where('subcategory_id','=',$id)->update(['product_status'=>$request->subcategory_status]);
        Wishlist::where('subcategory_id','=',$id)->update(['product_status'=>$request->subcategory_status]); 
         return redirect('sub-category');
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
        $subcategory=SubCategory::findOrfail($id);
        Product::where('subcategory_id','=',$id)->update(['product_status'=>2]);
        MostFavorites::where('subcategory_id','=',$id)->update(['product_status'=>2]);
        Favorites::where('subcategory_id','=',$id)->update(['product_status'=>2]);
        Wishlist::where('subcategory_id','=',$id)->update(['product_status'=>2]); 
        SubCategory::where('id','=',$id)->update(['subcategory_status'=>2]);
        $subcategory->delete();
    }

    public function published($id){
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        Product::where('subcategory_id','=',$id)->update(['product_status'=>1]);
        MostFavorites::where('subcategory_id','=',$id)->update(['product_status'=>1]);
        Favorites::where('subcategory_id','=',$id)->update(['product_status'=>1]);
        Wishlist::where('subcategory_id','=',$id)->update(['product_status'=>1]); 
        SubCategory::where('id','=',$id)->update(['subcategory_status'=>1]);
        return back();
        
    }

    public function unpublished($id){
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        Product::where('subcategory_id','=',$id)->update(['product_status'=>2]);
        MostFavorites::where('subcategory_id','=',$id)->update(['product_status'=>2]);
        Favorites::where('subcategory_id','=',$id)->update(['product_status'=>2]);
        Wishlist::where('subcategory_id','=',$id)->update(['product_status'=>2]); 
        SubCategory::where('id','=',$id)->update(['subcategory_status'=>2]);
          return back();
    }

    public function apiSubCategory(){
        $subcategory = SubCategory::all();
        return Datatables::of($subcategory)
            ->addColumn('action',function($subcategory){ 
                 if ($subcategory->subcategory_status == 1){
                return 

                '<a onclick="unpublished('.$subcategory->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">cloud_download</i></a>'.

                '<a href="/sub-category/'.$subcategory->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.

                '<a onclick="deletes('.$subcategory->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}

                else if ($subcategory->subcategory_status == 2){
                return 
                '<a onclick="published('.$subcategory->id.')"  class="btn btn-success waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">cloud_upload</i></a>'.

                '<a href="/sub-category/'.$subcategory->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.

                 '<a onclick="deletes('.$subcategory->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                     })
            ->addColumn('category',function($subcategory){ 
                return 
                 '<p>'.$subcategory->category_name.'</p>'
                 ;})
             ->addColumn('status',function($subcategory){ 
                if ($subcategory->subcategory_status == 1){
                return '<a class="btn btn-success" name="'.$subcategory->subcategory_status.'">Published</a>';}
                else if ($subcategory->subcategory_status == 2){
                return '<a class="btn btn-danger" name="'.$subcategory->subcategory_status.'">UnPublished</a>';}
            })->make(true);

}
}
