<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use PhpParser\Node\Stmt\ElseIf_;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
 //just login with mobile & email
        $login = request()-> input('identify');
       $field= filter_var($login,FILTER_VALIDATE_EMAIL)? 'email':'mobile';
       request()->merge([$field=>$login]);
       return $field;

 //other way login with mobile & email & username
/*
 $login = request()-> input('identify');
       $field='';
       if(filter_var($login,FILTER_VALIDATE_EMAIL)){
        $field='email';

       } elseif (filter_var($login,FILTER_VALIDATE_EMAIL)) {
           $field='mobile';
           # code...
       }
    else {
            $field='name';
        }


       request()->merge([$field=>$login]);
       return $field;
*/
    }
}
