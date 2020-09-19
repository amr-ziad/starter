<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{

    public function getindex(){

        $obj=new \stdClass();
        $obj->name='amr';
        $obj->id=5;
        $obj->gender='male';
        $data=[];
        return view('welcome',compact('obj','data'));

    }
    //
}
