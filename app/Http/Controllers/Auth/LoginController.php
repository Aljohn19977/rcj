<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Model\user\User;
use Auth; 
use Redirect;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
            
        $this->middleware('guest', ['except' => 'logout']);
    }

     protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password');//
        return ['email'=>$request{$this->username()}, 'password'=>$request->password,'status'=>'1'];
    }

    protected function sendLoginResponse(Request $request)
    {

        $findUser = User::where('email',$request->email)->first();

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }


    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        $findUser = User::where('email',$userSocial->email)->first();
        $findUser_status = User::where('email',$userSocial->email)->value('status');

        if($findUser && $findUser_status==1){
            Auth::login($findUser);
            return back();
        }
        if($findUser && $findUser_status==2){
            return redirect('/login');
        }else
            $user = new User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->status = 1;
            $user->type = 2;
            $user->password = bcrypt('rcjlucena2017');
            $user->save();

            Auth::login($user);
            return back();
    }
}
