<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service,Request $request)
    {
            $user = Socialite::driver($service)->stateless()-> user() ;
               response() -> json($user);
              if (!$user) {
                $user= User::create([
                     'name'=>$user->email,
                     'email'=>$user->name,
                     

                 ]);

             }
             Auth::login($user,true);
             return redirect($this->redirectTo());
            }



    /*
    public function callback($service){
    //return
    $user= Socialite::with($service)->user();
   // Response::json($user);
  if (!$user) {
  User::create([
       'name'=>$user->name,
       'email'=>$user->email,
       'password'=>'123456789',
       'mobile'=>'123456789',



   ]);
  }
Auth::login($user,true);
return redirect($this->redirectTo());
    }

    public function redirect($service){
        $face= Socialite::driver($service)->user();
        $user=User::where('provider_id',$face->getId())->first();
if (!$user) {
   $user= User::create([
        'name'=>$face->getEmail(),
        'email'=>$face->getName(),
        'provider_id'=>$face->getId(),

    ]);

}

Auth::login($user,true);
return redirect($this->redirectTo());



    }
*/

    //
    }
