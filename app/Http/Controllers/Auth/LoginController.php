<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    public function redirectTo(){
        if(Auth::user()->user_lvl ==4){
            $this->redirectTo = '/procurement/items';
            return $this->redirectTo;
        }
        if(Auth::user()->user_lvl ==3){
            $this->redirectTo = '/bac/users';
            return $this->redirectTo;           
        }
        if(Auth::user()->user_lvl ==2){
            $this->redirectTo = '/vp/approvals';
            return $this->redirectTo;           
        }
        if(Auth::user()->user_lvl ==5){
            $this->redirectTo = '/budget/submissions';
            return $this->redirectTo;           
        }
        if(Auth::user()->user_lvl ==6){
            $this->redirectTo = '/user/submission';
            return $this->redirectTo;      
        }
        if(Auth::user()->user_lvl ==1){
            $this->redirectTo = '/op/approvals';
            return $this->redirectTo;
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
