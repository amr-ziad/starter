@extends('layouts.app')

@section('content')

    <div class="alert alert-success" id="success_msg" style="display: none;">
        تم الحذف بنجاح
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.offer name')}}</th>
            <th scope="col">{{__('messages.offer price')}}</th>
            <th scope="col">{{__('messages.offer details')}}</th>
            <th scope="col">صوره العرض</th>

            <th scope="col">{{__('messages.operation')}}</th>
        </tr>
        </thead>
        <tbody>

<?php $i=0 ?>
        @foreach($offers as $offer)
        <?php $i++ ?>
            <tr class="offerRow{{$offer->id}}">
                <th scope="row">{{ $i }}</th>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}}</td>
                <td>{{$offer->details}}</td>
                <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>

                <td>
                    <a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-success"> {{__('messages.update offer')}}</a>
                    <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-danger"> {{__('messages.delete offer')}}</a>

                    <a href="{{route('ajax.offers.edit',$offer->id)}}" class="btn btn-success"> {{__('messages.update offer')}}</a>
                    <a href="" offer_id="{{$offer->id}}"  class="delete_btn btn btn-danger">{{__('messages.delete offer')}}</a>
                </td>

            </tr>
        @endforeach

        </tbody>



    </table>
    <div class=" justify-content-center">
        {{ $offers->links() }}
    </div>

@stop



@section('scripts')
    <script>
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
              var offer_id =  $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                 url: "{{route('ajax.offers.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :offer_id
                },
                success: function (data) {
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();
                }, error: function (reject) {
                }
            });
        });
    </script>
@stop
