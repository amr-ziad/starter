
@extends('layouts.app')

@section ('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

    </div>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="title m-b-md">
                  {{ __('messages.Add Your Offer')}}
                </div>
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif


                <form method="POST" id="offerForm" action="" enctype="multipart/form-data">  {{-- url('offers\store') --}}
                    @csrf
                    {{-- <input type="hidden"name="_token" value="{{ csrf_token() }}"> --}}

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
                    <small id="photo_error" class="form-text text-danger"></small>

                </div>

                     <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.offer name ar')  }}</label>
                      <input type="text" name="name_ar" class="form-control" autofocus aria-describedby="emailHelp" placeholder="{{__('messages.offer name')  }}">

                     <small id="name_ar_error" class="form-text text-danger"></small>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name en')  }}</label>
                        <input type="text" name="name_en" class="form-control" autofocus  placeholder="{{__('messages.offer name')  }}">

                       <small id="name_en_error"  class="form-text text-danger"></small>

                      </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{__('messages.offer price')  }}</label>
                      <input type="text" name="price" class="form-control" autofocus  placeholder="{{__('messages.offer price')  }}">

                      <small id="price_error"  class="form-text text-danger"></small>

                       </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details ar')  }}</label>
                        <input type="text" name="details_ar" class="form-control" autofocus  placeholder="{{__('messages.offer details')  }}">

                        <small id="details_ar_error"  class="form-text text-danger"></small>

                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details en')  }}</label>
                        <input type="text" name="details_en" class="form-control" autofocus  placeholder="{{__('messages.offer details')  }}">

                        <small id="details_en_error"  class="form-text text-danger"></small>

                      </div>

                    <button id="Save" class="btn btn-primary">{{__('messages.save offer')  }}</button>


                  </form>

            </div>
        </div>
    </div>

    <!--script-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>

@stop

@section('scripts')
<script>
    $('#Save').click(function (event){
        event.preventDefault();
        $('#photo_error').text('');
        $('#name_ar_error').text('');
        $('#name_en_error').text('');
        $('#price_error').text('');
        $('#details_ar_error').text('');
        $('#details_en_error').text('');
        var formData = new FormData($('#offerForm')[0]);// بدال جميع الحقول الي كانو في data

        $.ajax({
           // 'name_ar':$("input[name='name_ar']").val(),
            type:'post',
            dataType:'json',
            enctype:'multipart/form-data',
            url:"{{route('ajax.offers.store')}}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data.status == true) {
                    $('#success_msg').show();
                }
            }, error: function (reject) {
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) // تعمل فور لوب ل يررور
                {
                    $("#" + key + "_error").text(val[0]);
                });
            }
        });
    });
</script>
@stop
