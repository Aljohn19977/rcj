<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ContactUs;
use App\Mail\replyInquery;
use Mail;
use Session;
use Redirect;
use Auth;

class AdminContactUsController extends Controller
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
        return view('admin_ui.view-contact_us');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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
      $ContactUs = ContactUs::findOrFail($id);

      return view('admin_ui.edit-contact_us',compact('ContactUs')); 
    }

    public function reply(Request $request)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
      ContactUs::where('id',$request->id)->update(['status'=>1]);
      Mail::send(new replyInquery());
      Session::flash('message', "Email have been send succesfully.");
      return Redirect::back();

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
        $inq = ContactUs::findOrFail($id);
        $inq->delete();
    }

     public function apicontactUs(){

        $ContactUs = ContactUs::all();
        return Datatables::of($ContactUs)
            ->addColumn('action',function($ContactUs){ 
                 if ($ContactUs->status == 1){
                return 
                '<a href="/admin/contact_us/'.$ContactUs->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.

                '<a onclick="deletes('.$ContactUs->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}

                else if ($ContactUs->status == 2){
                return 
                '<a href="/admin/contact_us/'.$ContactUs->id.'/edit" class="btn btn-info waves-effect" style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">mode_edit</i></a>'.

                 '<a onclick="deletes('.$ContactUs->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                     })

             ->addColumn('status',function($ContactUs){ 
                if ($ContactUs->status == 1){
                return '<a class="btn btn-success" name="'.$ContactUs->status.'">Answered</a>';}
                else if ($ContactUs->status == 2){
                return '<a class="btn btn-danger" name="'.$ContactUs->status.'">Not Yet Answered</a>';}
            })->make(true);

}
}
