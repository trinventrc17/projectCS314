@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Choose Type

                    </div>

                    <div class="panel-body">

                    <div align="center">
                        <a href="{{ url('rooms/' .$id . '/movieChooseRoomType') }}">
                            <button type="submit" class="btn btn-primary" style="width:50%">Movie</button>
                        </a>
                    </div>
                    <br>
                    <div align="center">
                        <a href="{{ url('rooms/' .$id . '/ktv') }}">
                            <button type="submit" class="btn btn-primary" style="width:50%">Ktv</button>        
                        </a>
                    </div>


                    </div>
                </div>

            </div>
        </div>
    </div>







@endsection