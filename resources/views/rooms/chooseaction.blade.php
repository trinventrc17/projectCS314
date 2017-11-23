
@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading"> 
                        <div align="center">What do you want to do next?</div>
                    </div>

                    <div class="panel-body">

                <div class="col-md-10 col-md-offset-1">

                    <div align="center" >
                        <a href="{{ url('rooms/' .$id . '/movieOrKtv') }}"><button type="submit" class="btn btn-primary" style="width:70%">Walk In</button></a>   
                    </div>
                    <br>
                    <div align="center" >
                        <a href="{{ url('rooms/' .$id . '/reserve') }}"><button type="submit" class="btn btn-primary" style="width:70%">Reserve Room</button></a>   
                    </div>
                    <br>
<!--                     <div align="center" >
                        <a href="{{ url('home') }}"><button type="submit" class="btn btn-primary" style="width:70%">Nothing,Take me back!</button></a>   
                    </div> -->

                </div>                  
 
                    </div>
                </div>

            </div>
        </div>
    </div>







@endsection