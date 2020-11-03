<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table="doctors";
    protected $fillable=['name','title','hospital_id','medical_id','gender','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function hospital(){

        return $this->belongsTo('App\Models\Hospital','hospital_id','id');
    }

    public  function services(){

        return $this->belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');
    }

    // accessors get   مهم جدا في الاستخدام لتخفيف الكود واستخدامه في جميع الصفحات الخاصة في مودل الدكتور
// getGenderAttribute  يجب وضع الحقل المراد عمل عليه في وسط الكلمتين
    public function getGenderAttribute($val){
      return  $val==1?'male':'female';

    }

    // mutators  set اضافة لقاعدة البياانات
    public function setNameEnAttribute($value)
    {
    $this->attributes['name_en'] = strtoupper($value);
    }
    //
}
