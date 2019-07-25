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
use App\CarouselImages;
use App\ShipSocial;
use Session;
use Redirect;
use Auth;

class AdminCarouselController extends Controller
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
         $logo = ShipSocial::where('item','=','logo')->get();
         $productimage = CarouselImages::get();
        return view('admin_ui.view-carousel',compact('productimage','logo'));
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


    public function delete_image($id)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $productimage = CarouselImages::findOrfail($id);
        $productimage->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function logo_upload(Request $request)
    {
           
            $file = $request->file('file');
            $filename =time().$file->getClientOriginalName();
            $file->move('images/logo',$filename);
            $filePath ="images/logo/$filename";
            $products = ShipSocial::where('id','=',5)->update(['value'=>$filePath]);
            
             Session::flash('message2', "Successfully Updated.");
             return Redirect::back();
    }

    public function image_upload(Request $request)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        $carouselimage_count = CarouselImages::count();
        $req_file = count($request->file);

        if(($carouselimage_count+$req_file)>3){
                 Session::flash('messages', "Failed to upload you exceeded to the maximum image upload.");
                return Redirect::back(); 
        }

        $this->validate($request,[
        'file' => 'required',
        'file.*' => 'image|mimes:jpeg|max:2048'
         ]);

        if($request->hasFile('file')){
        foreach ($request->file as $file) {
            $filename =time().$file->getClientOriginalName();
            $file->move('images/carousel',$filename);
            $filePath ="images/carousel/$filename";
            $products = new CarouselImages;
            $products->image_path = $filePath;
            $products->save();
        }
    }
        Session::flash('message', "Successfully Uploaded.");
        return Redirect::back();
    }

    /**
     * Display the specified resource.
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


}
