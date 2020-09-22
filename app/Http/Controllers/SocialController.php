<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function redirect($service){

return Socialite::driver($service)->redirect();

    }
    public function callback($service){
    return $user= Socialite::with($service)->user();
    }

    //
}
