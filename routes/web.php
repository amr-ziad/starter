<?php

use App\Http\Controllers;
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








Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', function () {

    return view('landing');
});

Route::get('/redirect/{service}','SocialController@redirect');
Route::get('/callback/{service}','SocialController@callback');

//Route::get('fillable','NewsController@getoffers');
Route::group(['prefix' =>LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function () {
Route::group(['prefix' => 'offers'], function () {
//Route::get('store', 'NewsController@store');
//LaravelLocalization::setLocale() تقوم بمعرفة ar or en تلقائي
//	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

    Route::get('create','NewsController@create');
});
Route::post('store','NewsController@store')->name('offers.store');
});
