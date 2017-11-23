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

                    <div class="pull-right">
                         <a href="{{ url('customers/create') }}" class="btn btn-primary btn-xs">Add new Room</a>
                    </div>

                    </div>

                    <div class="panel-body">

                  @foreach ($customers as $key => $customer)
                  <a href="{{ url('RoomsTrack/' . $customer->id . '/chooseAction') }}">         
                    <div class="col-md-4"> <!-- start-col -->
                        @if($customer->address == 'Available')            
                        <div class="well" style="background-color:#ecf0f1">
                        @else
                        <div class="well" style="background-color:#e74c3c">
                        @endif
                                <p style="color:black">{{$customer->name}}</p>
                                <li style="color:black">{{$customer->address}}</li>
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