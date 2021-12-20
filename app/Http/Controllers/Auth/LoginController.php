<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
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
    protected function authenticated(Request $request, $user) {

       if( $user->isBlock == 1 ){
            Auth::logout();
            return redirect()->route('login')->with('message','Your account has been suspended. ');
       }
       else {
            if( $user->hasRole('admin') ) {
                return redirect()->route('admin');
            }
            else {
                return redirect()->route('user');
            }
       }

        // if($user->isBlock == 0) {
        //     
        // }
        // else {
        //     return redirect()->back()->with('message', 'Account has been suspended.');
        // }

      
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
