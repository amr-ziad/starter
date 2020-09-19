<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class FirstController extends Controller
{
public function __construct()
{
$this -> middleware('auth')->except('showString1');
}

    public function showString(){

        return'static string';
    }
    public function showString1(){

        return'static string1';
    }

    //
}
