@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading"> Choose Room Type

                    </div>

                    <div class="panel-body">
                    <div align="center">
                        <a href="{{ url('rooms/' .$id . '/ktvGoodFor4') }}">
                        <button type="submit" class="btn btn-primary">Good For 4</button>
                        </a>
                    </div>
                        <br>                        

                    <div align="center">
                        <a href="{{ url('rooms/' .$id . '/ktvGoodFor8') }}">
                        <button type="submit" class="btn btn-primary">Good For 8</button>
                        </a>
                    </div>
                        <br>                        


                            <div align="pull-right" >
                                <a href="{{ url('/home') }}">
                                    <button type="submit" class="btn btn-primary">Cancel</button>
                                </a>   
                            </div>

                    </div>
                </div>

            </div>
        </div>
    </div>







@endsection