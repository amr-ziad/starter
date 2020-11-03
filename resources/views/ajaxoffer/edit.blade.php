@extends('layouts.app')
@section('content')
<head>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->

<style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم  التحديث بنجاح
        </div>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add Your Offer')}}

                </div>
                '
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <br>
                <form method="POST"  id="offerFormUpdate" action="" enctype="multipart/form-data">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">{{__('messages.offer photo')  }}</span>
                            </div>
                            <div class="custom-file">
                            <input type="file" name="photo" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" autofocus>

                                <label class="custom-sfile-label" for="inputGroupFile01">Upload your photo</label>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name ar')}}</label>
                        <input type="text" class="form-control" value="{{$offer->name_ar}}" name="name_ar"
                               placeholder="{{__('messages.offer name')}}">
                        @error('name_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <input type="text" style="display: none;" class="form-control" value="{{$offer -> id}}" name="offer_id">

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name en')}}</label>
                        <input type="text" class="form-control" value="{{$offer -> name_en}}" name="name_en"
                               placeholder="{{__('messages.offer name')}}">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer price')}}</label>
                        <input type="text" class="form-control" value="{{$offer -> price}}" name="price"
                               placeholder="{{__('messages.offer price')}}">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details ar')}}</label>
                        <input type="text" class="form-control" value="{{$offer -> details_ar}}" name="details_ar"
                               placeholder="{{__('messages.offer details')}}">
                        @error('details_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{__('messages.offer details en')}}</label>
                        <input type="text" class="form-control" value="{{$offer -> details_en}}" name="details_en"
                               placeholder="{{__('messages.offer details')}}">
                        @error('details_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <button id="update_offer" class="btn btn-primary">{{__('messages.update offer')}}</button>
                </form>


            </div>
        </div>
    </div>
</body>
@stop

@section('scripts')
    <script>
        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();
            var formData = new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                }, error: function (reject) {
                }
            });
        });
    </script>
@stop
