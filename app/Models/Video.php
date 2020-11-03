<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table="videos";
    protected $fillable=['name','viewer','created_at','updated_at'];// عدد واي حقول تريد عمل لها ادخال
    protected $hidden=['created_at','updated_at'];



    //
}
