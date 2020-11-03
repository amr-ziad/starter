<?php

namespace App\Http\Controllers\Relations;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;

class relationsController extends Controller
{
    /////
   public function hasOneRelation()
   {
    $user = User::with(['phone'=>function($q){ // تقوم باستدعاء اسم العلاقة ومن ثم يتم الاستعلام عن الحقول
        $q->select('code','phone','user_id');
    }])->find(1);

    //return $user->phone->code;// يستدعي الحقل من العلاقة الموجودة
     // $user->phone;// استدعاء اسم العلاقة
    return response()->json($user);

   }
/////
   public function hasOneRelationReserve(){
 //$phone = Phone::with('user')->find(1); // تقوم بارجاع جميع البيانات الخاصة في اليوزر
 $phone = Phone::with(['user'=>function($q){// تقوم بارجاع البيانات المحددة الخاصة باليوزر
     $q->select('id','name');
 }])->find(1);


// make attribute visible
$phone->makeVisible(['user_id']); // makeVisible  تظهر الحقل الخفي من الداتا بيس
//$phone->makeHidden(['code']);// makeHidden  تقو مالدالة باخفاء حقل معين من الداتا بيس
//return $phone->user;//ترجع اليوزر صاحب رقم الجوال من العلاقة user
// get all data phone + user

return $phone;
}
/////
public function getuserhasphone(){
   //return User::whereHas('phone')->get();//دالة ترجع اليوزرز التي لها ارقام جوالات

   return User::whereHas('phone',function($q){
       $q->where('code','056');
   })->get();//الكود ال دالة ترجع اليوزرز التي لها ارقام جوالات الكود الخاص  بهم 059

}
/////

public function getusernothasphone(){
    return User::whereDoesntHave('phone')->get();// دالة ترجع اليزرز التي ليست لها ارقام جوالات
 }

 // one To mane relationship
public function gethospitalhasmany(){
//$hospital=Hospital::find(1); // Hospital::where('id',1)->first();
//return $hospital->doctors;// return hospital doctors
$hospital=Hospital::with('doctors')->find(1);
//return $hospital;
$doctros=$hospital->doctors;
// عرض اسماء الدكاترة في المستشفى
foreach($doctros as $doctor){
echo $doctor->name .'<br>';
}

$doctor=Doctor::find(2);
return $doctor->hospital;
}
/////
public function hospital(){
$hospitals=Hospital::select('id','name','address')->get();
    return view('doctors.hospitals',compact('hospitals'));
}
/////
public function doctor($hospital_id)
{
$hospital = Hospital::find($hospital_id);
$doctors = $hospital->doctors;
return view('doctors.doctors',compact('doctors'));

}
//get all hospital which has doctors
public function hospitalhasdoctor()
{
$hospital=Hospital::whereHas('doctors')->get();
return $hospital;
}

public function hospitalhasdoctormale()
{
  return  $hospital = Hospital::with('doctors')-> whereHas('doctors' , function($q)
    {
        $q ->where('gender',1);
    })->get();
}
/////
public function hospitalnothasdoctor()
{
   return Hospital::whereDoesntHave('doctors')->get();
}
/////
public function deletehospital($hospital_id)
{
$hospital=Hospital::find($hospital_id);
if(!$hospital)
return abort('404');
// delete doctors in the hospital
$hospital->doctors()->delete();// delete doctors
$hospital->delete();// delete hospital
return redirect()->route('hospitals');
}
/////
public function getDoctorServices(){

    return $doctor=Doctor::With('services')->find(5);
    $doctor->name;
   return $doctor->services;

}
////
public function getServicesDoctor(){
return $doctors=Service::With('doctors')->find(1);

}
/// احضار و عرض الخدمات لكل دكتور
public function Services($doctorID){
$doctor=Doctor::find($doctorID);
$services=$doctor->Services; //doctor services
$doctors=Doctor::select('id','name')->get();
$allservices=Service::select('id','name')->get();// all databace services
return view('doctors.services',compact('services','doctors','allservices'));

}
////
public function saveServices(Request $request){
$doctor=Doctor::find($request->doctor_id);
if(!$doctor)
return abort('404');
//$doctor->services()->attach($request->servicesIds);// many to many insert to databace مع تكرار البيانات اذا كانت موجودة في الجدول
//$doctor->services()->sync($request->servicesIds);// many to many insert to databace دون التكرار update
$doctor->services()->syncWithoutDetaching($request->servicesIds);//many to many insert to databace دون التكرار ودون حذف القديم
return redirect()->back();
}
//////
public function getPatientDoctor(){
   $patient= Patient::find(2);
   $patient->doctor->hospital;
    return $patient;
}
public function getCountryDoctor(){

   $country= Country::find(1);
   $country->doctors;
   return $country;
}

public function getCountryHospital(){
    $country=Country::find(1);
    $country->hospitals;
    return $country;
}

public function getdoctor(){
$doctor= Doctor::select('id','name','gender')->get();
if(isset($doctor)&&$doctor->count()>0){
// foreach($doctor as $doc){

//     $doc->gender=$doc->gender == 1 ? 'male':'female';
//     $doc->newVal='new';

// }
 }
 return $doctor;
}
    //
}


