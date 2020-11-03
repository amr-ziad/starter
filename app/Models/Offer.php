<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table="offers";
    protected $fillable=['name_ar','name_en','price','details_ar','details_en','photo','status','created_at','updated_at'];// عدد واي حقول تريد عمل لها ادخال
    protected $hidden=['created_at','updated_at'];//يخفي ظهور الحقلين في عملية الاستدعاء من الجدول
   // public $timestamps=false;

// local scope
   // how use scope استخدام ال سكوب في نقليل كتابة الاكود في جملة الكويري
public function scopeInactive($q){

    return $q->where('status',0);
}
public function scopeInvalid($q){

    return $q->where('status',0)->whereNull('details_ar');
}

//// register globel scope  الدالة ضرورية لعمل سكوب كلوبل
// protected static function boot(){
//     parent::boot();// ينادي عالاب الخاص به
// static::addGlobalScope(new OfferScope);

//}
    //
}
