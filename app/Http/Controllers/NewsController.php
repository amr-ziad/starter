<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use App\Events\VideoViewer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferReguest;
use App\Http\Requests\OfferRequest;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class NewsController extends Controller
{
    use OfferTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function getoffers()
    {
        return Offer::select('id','name')->get();

    }
    */
/*public function store(){
Offer::create([
'name'=>'offer1',
'price'=>'9000',
'details'=>'offers details',

]);

}
*/

    public function index()
    {
        return'in index method';
        //
    }
    public function getAllOffers()
    {
    //   $offers=Offer::select('id','price','photo','name_'.LaravelLocalization::getCurrentLocale().' as name'
    //   ,'details_'.LaravelLocalization::getCurrentLocale().' as details'
    //   )->get();//return collection of all result

    // paginate result

    $offers=Offer::select('id','price','photo','name_'.LaravelLocalization::getCurrentLocale().' as name'
    ,'details_'.LaravelLocalization::getCurrentLocale().' as details'
    )->paginate(PAGINATION_COUNT);//return collection of paginate result

      return view('offers.all',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offers.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        //validate data before insert to databace



/*
        $rules=$this->getRules();
        $messages=$this->getMessages();

        $validator =Validator::make($request->all(),$rules,$messages);
        if ($validator -> fails()) {
          //  return $validator -> errors();
        return redirect()->back()->withErrors($validator)->withInput($request->all());


        }
        */

        $file_name = $this->saveImage($request->photo,'images/offers');
        // save photo in folder
        /*
$file_extension=$request -> photo -> getClientOriginalExtension();
$file_name=time().'.'.$file_extension;
$path='public/images/offers';
$request -> photo->move($path,$file_name);
*/

        // insert data
        Offer::create([
        'name_ar' =>$request->name_ar,
        'name_en' =>$request->name_en,
        'photo' =>$file_name,
        'price' =>$request->price,
        'details_ar' =>$request->details_ar,
        'details_en' =>$request->details_en,

        ]);

        return redirect()->back()->with(['success'=>'تمت الاضافة بنجاح']);
        //
    }
    /*
protected function saveImage($photo,$folder){

// save photo in folder
$file_extension=$photo-> getClientOriginalExtension();
$file_name=time().'.'.$file_extension;
$path=$folder;
$photo->move($path,$file_name);
return $file_name;
}
*/



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return'in show method';
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function editOffer($offer_id)
     {
       // Offer::findOrFail($offer_id);// عمل فحص ان كان الاي دي موجود او لا
       $offer= Offer::find($offer_id);// بحث في الجدول عن الاي دي
        if(!$offer)
        return redirect()->back();
      $offer= Offer::select('id','name_ar','name_en','details_ar','details_en','price')->find($offer_id);
        return view('offers.edit',compact('offer'));
    }


    public function updateOffer(OfferRequest $request,$offer_id)
    {
        // validation request offerRequest
        //chek if offer exists
        $offer= Offer::find($offer_id);  // بحث في الجدول عن الاي دي
        //if(!$offer)
        //return redirect()->back();

        // update data

        $offer->update($request->all());
        return redirect()-> back()-> with(['success'=>'تم التحديث بنجاح']);

        /*
        $offer->update([
        'name_ar'=>$request->name_ar,
        'name_en'=>$request->name_en,
        'price'=>$request->price,
        ]);
        */
    }
    public function deleteoffer($offer_id)
    {
        // check if offer id exists
       $offer= Offer::find($offer_id);
        if (!$offer) {
        return redirect() -> back() -> with(['error' =>__('messages.offer not exist')]);
        }

        $offer->delete();
        return redirect()->route('offers.all')->with(['success'=>__('messages.offer deleted  successfully')]);
    }

/*
public function deleteoffer($offer_id)
{
    // check if offer id exists
    $offer= Offer::find($offer_id); //Offer ::where('id','$offer_id')->first();
     if (!$offer)



}
*/








    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // show video
    public function getVideo()
{
    $video= Video::first();
   event(new VideoViewer($video));
    return view('video')->with('video',$video);

}
/////
/// where  / whereNull  / whereNotNull / whereIn
// how use  scope    (local scope) $$globel scope
public function getallinactiveoffers(){
   // Offer::whereNotNull('name_ar')->get();
//$inactive=Offer::where('status',0)->->get();//all inactive offers
//$inactive=Offer::where('status',0)->whereNotNull('name_ar')->get();//many condiaion
//$inactive= Offer::invalid()->get();
//$inactive= Offer::inactive()->get();

// global scope  تكتب من غير اي شرط
//$inactive= Offer::get();
// how to remove global scope
$inactive= Offer::withoutGlobalScope(OfferScope::class)->get();
return $inactive;
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


/*
    protected function getMessages()
    {
        return   $messages = [
            'name.required'=>__('messages.offer name required'),// trans('messages.offer name required'), // the same
            'name.unique' =>__('messages.offer name must be unique'),
            'price.required' => __('messages.offer price'),
            'price.numeric' => __('messages.price numeric'),
            'details.required'=>__('messages.offer details'),
        ];
}
protected function getRules(){

    return $rules = [

        'name' => 'required|max:100|unique:offers,name',
        'price' => 'required|numeric',
        'details' => 'required',

    ];
}
*/


        }

