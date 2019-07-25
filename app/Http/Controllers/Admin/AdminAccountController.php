<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Model\user\User;
use App\Model\admin\Admin;
use Auth;
class AdminAccountController extends Controller
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
        return view('admin_ui.view-account');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function published($id)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        User::where('id','=',$id)->update(['status'=>1]);
        return back();
        
    }
    public function unpublished($id)
    {
        if(Auth::check()){
             $user_id = auth::user()->id;
             if($user_id==2){
              return redirect('/delivery/payment');
             }   
        }
        User::where('id','=',$id)->update(['status'=>2]);
        return back();
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
        $user = User::findOrfail($id);
        User::where('id',$id)->update(['status'=>2]);
        $user->delete();
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

    public function apiAccounts(){

        $user = User::where('status','!=',0)->get();
        return Datatables::of($user)
            ->addColumn('action',function($user){ 
                 if ($user->status == 1){
                return 

                '<a onclick="unpublished('.$user->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">cloud_download</i></a>'.

                '<a onclick="deletes('.$user->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}

                else if ($user->status == 2){
                return 
                '<a onclick="published('.$user->id.')"  class="btn btn-success waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">cloud_upload</i></a>'.

                 '<a onclick="deletes('.$user->id.')"  class="btn btn-danger waves-effect"style="float:left;margin-right:5px;margin-bottom:5px;"><i class="material-icons">delete</i></a>';}
                     })

             ->addColumn('status',function($user){ 
                if ($user->status == 1){
                return '<a class="btn btn-success" name="'.$user->status.'">Activated</a>';}
                else if ($user->status == 2){
                return '<a class="btn btn-danger" name="'.$user->status.'">Not Activated</a>';}
            })
             ->addColumn('via',function($user){ 
                if ($user->type == 1){
                return '<a class="btn bg-pink waves-effect" style="" name="'.$user->status.'">RCJ</a>';}
                else if ($user->type == 2){
                return '<a class="btn bg-indigo waves-effect" name="'.$user->status.'">Facebook</a>';}
            })->make(true);

}
}
