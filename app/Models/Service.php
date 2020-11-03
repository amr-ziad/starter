<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table="services";
    protected $fillable=['name','created_at','updated_at'];// عدد واي حقول تريد عمل لها ادخال
    protected $hidden=['created_at','updated_at','pivot'];//يخفي ظهور الحقلين في عملية الاستدعاء من الجدول

    public function doctors(){

        return $this->belongsToMany('App\Models\Doctor','doctor_service','service_id','doctor_id','id','id');
    }
    //
}
