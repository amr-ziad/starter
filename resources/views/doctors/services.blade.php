@extends('layouts.app')
@section('content')

        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="title m-b-md">
                  Services
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">opreation</th>

                      </tr>
                    </thead>
                    <tbody>
                        @if (isset($services)&& $services->count()>0)
                        @foreach ($services as $service)
                        <tr>
                            <th scope="row">{{ $service->id }}</th>
                            <td >{{ $service->name }}</td>


                            <td>


                            </td>


                          </tr>
                        @endforeach
                        @endif


                    </tbody>
                  </table>
                </div>
            </div>
            <hr>
            <br>

        <form method="POST" action="{{ route('saveServices') }}">
            @csrf
            <div class="form-group">
                <label >{{__('select doctor')  }}</label>
                <select  class="form-control" name="doctor_id">
                    @if (isset($doctors) && $doctors->count()>0)
                    @foreach ($doctors as $doctor)
                             <option   value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                         @endforeach
                        @endif

                   </select>
           </div>

             <div class="form-group">
                <label >{{__('select services')  }}</label>
                <select class="form-control" name="servicesIds[]" multiple><!-- ترجع اكتر من قيمة يجب ان تكون arry-->
                    @if (isset($allservices) && $allservices->count()>0)
                    @foreach ($allservices as $allservice)
                    <option   value="{{ $allservice->id }}">{{ $allservice->name }}</option>

                        @endforeach
                        @endif
                   </select>
           </div>
                        <button type="submit" class="btn btn-primary">{{__('messages.save offer')  }}</button>
                    </form>




@stop
