<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Model\user\User;
use App\Model\admin\Admin;
use Purifier;
use Auth;
class AccountAdminController extends Controller
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
        $admin = Admin::where('id','=',1)->first();
        return view('admin_ui.view-admin-account',compact('admin'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response

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
         $admin = Admin::where('id','=',1)->first();
        return view('admin_ui.edit-admin-account',compact('admin'));
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
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Admin::findOrFail($id);
         $admin->update(['password' => bcrypt($request['password']),'email' => Purifier::clean($request->email) ]);
           return redirect('/account/admin/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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

}
