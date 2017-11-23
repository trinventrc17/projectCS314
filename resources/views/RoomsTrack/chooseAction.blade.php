@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading"> Choose Action

                    </div>

                    <div class="panel-body">

                  <a href="{{ url('RoomsTrack/' .$sendId . '/walkin'. '/actionChosen') }}"><button type="submit" class="btn btn-primary">Walk In Sale</button>
                  </a>
                    
                    </div>
                </div>

            </div>
        </div>
    </div>







@endsection