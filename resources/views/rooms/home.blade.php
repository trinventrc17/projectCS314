@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">List of Rooms

                    </div>

                    <div class="panel-body">

                  @foreach ($rooms as $key => $room)
                  <a href="{{ url('rooms/' . $room->id . '/checkstatus') }}">         
                    <div class="col-md-4"> <!-- start-col -->
                        @if($room->status == 'Available')            
                        <div class="well" style="background-color:pink">
                        @else
                        <div class="well" style="background-color:yellow">
                        @endif
                                <p style="color:black">{{$room->name}}</p>
                                <li style="color:black">{{$room->status}}</li>
                                @php ($i = 0)
                                @foreach ($sales as $key => $sale)
                                    @if($sale->session == $room->session)
                                        @php ($i = $key)
                                    @else
                                    @endif
                                @endforeach
                              @if($i !=0)  
                             @else
                             @endif
                             <br>
                        </div> <!-- end-well -->
                    </div> <!-- end-col -->
                    </a>

                @endforeach


                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection