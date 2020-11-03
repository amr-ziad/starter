<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">{{ __('messages.amr') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li class="nav-item active">
          <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}</a>
        </li>
        @endforeach


        {{-- @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>
                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
        @endforeach --}}

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>






        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="title m-b-md">
                  {{ __('messages.Update Offer')}}
                </div>
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif


                <form method="POST" action="{{ route('offers.update',$offer->id) }}"> {{-- url('offers\store') --}}
                    @csrf
                    {{-- <input type="hidden"name="_token" value="{{ csrf_token() }}"> --}}
                    {{--
      @if (LaravelLocalization::getCurrentLocale()=='ar')
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name ar')  }}</label>
                        <input type="text" name="name_ar" value="{{ $offer->name_ar }}" class="form-control" autofocus aria-describedby="emailHelp" placeholder="{{__('messages.offer name')  }}">
                       @error('name_ar')
                       <small class="form-text text-danger">{{ $message }}</small>
                       @enderror
                      </div>
                      <div>
                      <label for="exampleInputPassword1">{{__('messages.offer price')  }}</label>
                      <input type="text" name="price" value="{{ $offer->price }}" class="form-control" autofocus  placeholder="{{__('messages.offer name')  }}">
                      @error('price')
                      <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                       </div>

                       <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details ar')  }}</label>
                        <input type="text" name="details_ar" value="{{ $offer->details_ar }}" class="form-control" autofocus  placeholder="{{__('messages.offer details')  }}">
                        @error('details_ar')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      @else
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name en')  }}</label>
                        <input type="text" name="name_en" value="{{ $offer->name_en }}" class="form-control" autofocus aria-describedby="emailHelp" placeholder="{{__('messages.offer name')  }}">
                       @error('name_en')
                       <small class="form-text text-danger">{{ $message }}</small>
                       @enderror
                      </div>

                      <div>
                      <label for="exampleInputPassword1">{{__('messages.offer price')  }}</label>
                      <input type="text" name="price" value="{{ $offer->price }}" class="form-control" autofocus  placeholder="{{__('messages.offer name')  }}">
                      @error('price')
                      <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                       </div>

                       <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details en')  }}</label>
                        <input type="text" name="details_en" value="{{ $offer->details_en }}" class="form-control" autofocus  placeholder="{{__('messages.offer details')  }}">
                        @error('details_en')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                      </div>


                    @endif
                    --}}



                     <div class="form-group">
                      <label for="exampleInputEmail1">{{__('messages.offer name ar')  }}</label>
                      <input type="text" name="name_ar" value="{{ $offer->name_ar}}" class="form-control" autofocus aria-describedby="emailHelp" placeholder="{{__('messages.offer name')  }}">
                     @error('name_ar')
                     <small class="form-text text-danger">{{ $message }}</small>
                     @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name en')  }}</label>
                        <input type="text" name="name_en" value="{{ $offer->name_en }}" class="form-control" autofocus aria-describedby="emailHelp" placeholder="{{__('messages.offer name')  }}">
                       @error('name_en')
                       <small class="form-text text-danger">{{ $message }}</small>
                       @enderror
                      </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{__('messages.offer price')  }}</label>
                      <input type="text" name="price" value="{{ $offer->price }}" class="form-control" autofocus  placeholder="{{__('messages.offer name')  }}">
                      @error('price')
                      <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                       </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details ar')  }}</label>
                        <input type="text" name="details_ar" value="{{ $offer->details_ar }}" class="form-control" autofocus  placeholder="{{__('messages.offer details')  }}">
                        @error('details_ar')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details en')  }}</label>
                        <input type="text" name="details_en" value="{{ $offer->details_en }}" class="form-control" autofocus  placeholder="{{__('messages.offer details')  }}">
                        @error('details_en')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                    <button type="submit" class="btn btn-primary">{{__('messages.save offer')  }}</button>


                  </form>

            </div>
        </div>

    <!--script-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
