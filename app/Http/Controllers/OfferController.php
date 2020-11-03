<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

    public function create()
    {
        return view('ajaxoffer.create');
        // view from to aa this offer

    }
    public function store(OfferRequest $request)
    {
        //save offer into DB using AJAX

        $file_name = $this->saveImage($request->photo, 'images/offers');
        //insert  table offers in database
        $offer = Offer::create([
            'photo' => $file_name,
            'name_ar' =>$request->name_ar,          //strtoupper($request->name_ar) , // تعمل على حفظها بالاحرف الكبيرة
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,

        ]);

        if ($offer)
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
            ]);
    }
    //

    public function all(){

          $offers=Offer::select('id','price','photo','name_'.LaravelLocalization::getCurrentLocale().' as name'
          ,'details_'.LaravelLocalization::getCurrentLocale().' as details'
          )->paginate(PAGINATION_COUNT);//return collection ->limit(10) 10 elments
          return view('ajaxoffer.all',compact('offers'));

    }
    public function delete(Request $request){
        // check if offer id exists
        $offer= Offer::find($request->id);
        if (!$offer) {
        return redirect() -> back() -> with(['error' =>__('messages.offer not exist')]);
        }

        $offer->delete();
        return response()->json([

            'status'=>true,
            'msg'=>'تم الحذف بنحاج',
            'id'=>$request->id,

        ]);

    }

    public function edit(Request $request)
    {
      // Offer::findOrFail($offer_id);// عمل فحص ان كان الاي دي موجود او لا
      $offer= Offer::find($request->offer_id);// بحث في الجدول عن الاي دي
       if(!$offer)
       return response()->json([
        'status' => false,
        'msg' => 'هذا العرض غير موجود',
    ]);

     $offer= Offer::select('id','name_ar','name_en','details_ar','details_en','price')->find($request->offer_id);
       return view('ajaxoffer.edit',compact('offer'));
   }

   public function update(Request $request)
   {
    $offer= Offer::find($request->offer_id);
    if (!$offer) {
        return response()->json([
            'status' => false,
            'msg' => 'هذا العرض غير موجود',
        ]);
            }

    $offer->update($request->all());
    return response()->json([
        'status' => true,
        'msg'=>'تم التحديث بنحاج',
        ]);
   }
}
