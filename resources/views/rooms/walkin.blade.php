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
                    <form action="{{ url('rooms/'.$id.'/walkinsales') }}" method="POST">
                        {{ csrf_field() }}
                    {!! Form::label('roomType','Room Type') !!}
                    {!! Form::select('roomType', array('Good For 4' => 'Good For 4', 'Good For 2' => 'Good For 2' ,'Good For 8' => 'Good For 8'), '',['class'=>'form-control']) !!}

                    {!! Form::label('promoType','Promo Type') !!}
                    {!! Form::select('promoType', array('Happy Hour' => 'Happy Hour', 'Regular' => 'Regular'), '',['class'=>'form-control']) !!}

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="session" name="session" value="{{$sessionId}}">
                    </div>

                    <br>
                        <div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>

                    </form>
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