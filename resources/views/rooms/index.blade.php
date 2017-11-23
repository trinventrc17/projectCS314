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
                  <a href="{{ url('RoomsTrack/' . $room->id . '/chooseaction') }}">         
                    <div class="col-md-4"> <!-- start-col -->
                        @if($room->status == 'Available')            
                        <div class="well" style="background-color:#ecf0f1">
                        @else
                        <div class="well" style="background-color:#e74c3c">
                        @endif
                                <p style="color:black">{{$room->name}}</p>
                                <li style="color:black">{{$room->status}}</li>
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