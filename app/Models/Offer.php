<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table="offers";
    protected $fillable=['name','price','details','created_at','updated_at'];// عدد واي حقول تريد عمل لها ادخال
    protected $hidden=['created_at','updated_at'];//يخفي ظهور الحقلين في عملية الاستدعاء من الجدول
   // public $timestamps=false;

    //
}
