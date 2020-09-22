<?php

namespace App\Http\Controllers;

use App\Models\Offer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
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
    public function store(Request $request)
    {
        //validate data before insert to databace




        $rules=$this->getRules();
        $messages=$this->getMessages();

        $validator =Validator::make($request->all(),$rules,$messages);
        if ($validator -> fails()) {
          //  return $validator -> errors();
          return redirect()->back()->withErrors($validator)->withInput($request->all());


        }

        // insert data
        Offer::create([
        'name' =>$request->name,
        'price' =>$request->price,
        'details' =>$request->details,

        ]);

        return redirect()->back()->with(['success'=>'تمت الاضافة بنجاح']);
        //
    }

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function getMessages(){
        return   $messages = [
            'name.required'=>__('messages.offer name required'),// trans('messages.offer name required'), // the same
            'name.unique' =>__('messages.offer name must be unique'),
            'price.required' => 'سعرالعرض مطلوب',
            'price.numeric' => 'سعرالعرض ارقام',
            'details.required'=> 'التفاصيل  مطلوب',
        ];
}
protected function getRules(){

    return $rules = [

        'name' => 'required|max:100|unique:offers,name',
        'price' => 'required|numeric',
        'details' => 'required',

    ];
}

}
