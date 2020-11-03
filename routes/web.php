<?php

use App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/*Route::get('/', function () {
    $data=[];
    $data['id']=5;
    $data['name']='amr zaza';

    return view('welcome',//$data
);
});
*/
/*
Route::get('/','Front\UserController@getindex');

Route::get('/landing', function () {
return view('landing');
});

Route::get('/about', function () {
return view('about');
});

//route parameters
Route::get('/test1/(id)', function () {
    return 'wellcome';
});

Route::get('/test2/(id?)', function () {
    return 'wellcome';
});

//Route::get('/test1/(id?)', function () {
  //  return 'wellcome';
//})->name('a');// تسمية الرابط لاستخدامه



// controller middleware
//Route::get('/', function () {
 //   return 'wellcome';
//})->middleware('auth');  حيث تكون خاصة في الميثود هذه فقط

// شكل احترافي لروت ميثود
Route::group(['prefix' => 'users','middleware'=>'auth'], function () {
    Route::get('/', function () {
        return'work';

    });

});



//Route::get('First','Front\FirstController@showString');

Route::group(['namespace' => 'Front'], function () {
    Route::get('First','FirstController@showString')->middleware('auth');
Route::get('First1','FirstController@showString1');
});

Route::get('login', function () {
return'Must login To access';
})->name('login');

// resource all route
Route::resource('news', 'NewsController');// هذا يحتوي على حميع الروت الي تحت
//{//Route::get('news', 'NewsController@index');
//Route::post('news', 'NewsController@store');
//Route::get('news/create', 'NewsController@create');
//Route::get('news/{id }', 'NewsController@show');
//Route::get('news/{id}/edit', 'NewsController@edit');
//Route::post('update/{id}', 'NewsController@update');
//Route::delete('news/{id}', 'NewsController@delete');
//}






*/


// لتعميم التحديد عالصفحات بشكل كامل
define('PAGINATION_COUNT',4);




Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', function () {

    return view('landing');
});

//Route::get('/redirect','SocialController@redirect');
Route::get('redirect/{service}','SocialController@redirect');
Route::get('callback/{service}','SocialController@callback');

//Route::get('fillable','NewsController@getoffers');
//Route::get('store', 'NewsController@store');
//LaravelLocalization::setLocale() تقوم بمعرفة ar or en تلقائي
//	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

Route::group(['prefix' =>LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function ()
{
Route::group(['prefix' => 'offers'], function () {
    Route::get('create','NewsController@create');
    Route::post('store','NewsController@store')->name('offers.store');
    Route::get('all','NewsController@getAllOffers')->name('offers.all');

    Route::get('edit/{offer_id}','NewsController@editOffer');
    Route::post('update/{offer_id}','NewsController@updateOffer')->name('offers.update');
    Route::get('delete/{offer_id}','NewsController@deleteOffer')->name('offers.delete');
    Route::get('get-all-inactive-offers','NewsController@getallinactiveoffers');

});
Route::get('youtube','NewsController@getVideo')->middleware('auth');
});

### Begin Ajax routes  ###

Route::group(['prefix' => 'ajax-offers'], function ()
{
    Route::post('store','OfferController@store')->name('ajax.offers.store');
    Route::get('create','OfferController@create');

    Route::get('all','OfferController@all')->name('ajax.offers.all');
    Route::post('delete','OfferController@delete')->name('ajax.offers.delete');

    Route::get('edit/{offer_id}','OfferController@edit')->name('ajax.offers.edit');
    Route::post('update','OfferController@Update')->name('ajax.offers.update');

});

### end Ajax routes  ###


############Begin Authentication && Guards#####################
Route::group(['middleware' => 'CheckAge','namespace' => 'Auth'], function () {

    Route::get('Adualt','CustomAuthController@adualt')->name('adult');   //->middleware('CheckAuth');

});
Route::get('site','Auth\CustomAuthController@site')->middleware('auth:web')->name('site');   //->middleware('CheckAuth');  auth:web or auth هذه الافتراضية
Route::get('admin','Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');   //->middleware('CheckAuth');

Route::get('admin/login','Auth\CustomAuthController@adminlogin')->name('admin.login');   //->middleware('CheckAuth');
Route::post('admin/login','Auth\CustomAuthController@checkadminlogin')->name('save.admin.login');   //->middleware('CheckAuth');


############End Authentication && Guards######################

############begin relation routs######################
############begin one To many relationship routs######################
####
Route::get('has-one','Relations\relationsController@hasOneRelation');
Route::get('has-one-reserve','Relations\relationsController@hasOneRelationReserve');
Route::get('get-has-phone','Relations\relationsController@getuserhasphone');
Route::get('get-not-has-phone','Relations\relationsController@getusernothasphone');
Route::get('hospital-has-many','Relations\relationsController@gethospitalhasmany');
####
Route::get('hospitals','Relations\relationsController@hospital')->name('hospitals');
Route::get('doctors/{hospital_id}','Relations\relationsController@doctor')->name('hospital.doctors');
####DELETE
Route::get('hospitals/{hospital_id}','Relations\relationsController@deletehospital')->name('delete.hospital');
###
Route::get('hospital-has-doctors','Relations\relationsController@hospitalhasdoctor');
Route::get('hospital-has-doctors-male','Relations\relationsController@hospitalhasdoctormale');
Route::get('hospital-not-has-doctors','Relations\relationsController@hospitalnothasdoctor');
##
############end one To many relationship routs######################

############begin Many To many relationship routs######################
Route::get('doctors-services','Relations\relationsController@getDoctorServices');
Route::get('services-doctors','Relations\relationsController@getServicesDoctor');
##services doctor
Route::get('services/{doctor_id}','Relations\relationsController@Services')->name('Services');
Route::post('saveServices','Relations\relationsController@saveServices')->name('saveServices');
############end Mane To many relationship routs######################


############ has one through ######################
Route::get('has-one-through','Relations\relationsController@getPatientDoctor');

Route::get('has-many-through','Relations\relationsController@getCountryDoctor');
Route::get('Country_hospital','Relations\relationsController@getCountryHospital');


############  End relation routs######################


############Begin accessors and mutators######################

Route::get('accessors','Relations\relationsController@getdoctor');


############End accessors and mutators######################

