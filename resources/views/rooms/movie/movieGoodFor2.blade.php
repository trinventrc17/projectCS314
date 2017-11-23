@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="row">

            <form action="{{ url('rooms/'.$id.'/walkinsales') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="col-md-6 col-md-offset-0">

                <div class="panel panel-default">
                    <div class="panel-heading"> Movie Details

                    </div>

                    <div class="panel-body">
                    <div align="center">
                         Movie(s) Title here
                    </div>
                   
                    <div class="form-group" align="center">

                    <textarea name="movies" cols="50" rows="4" placeholder="Ex. Angry birds , 50 shades of Grey , Inception"></textarea>


                    </div>
                    <br>
                    
                    <div class="form-group">
                    {!! Form::label('numberOfMoviesOrHour','Number of Movies') !!}
                        <input type="number" class="form-control" id="numberOfMoviesOrHour" name="numberOfMoviesOrHour">
                    </div>

                    <div class="form-group">
                    {!! Form::label('startTime','Start Time') !!}
                        <input type="text" class="form-control" id="startTime" name="startTime">
                    </div>

                    <div class="form-group">
                    {!! Form::label('endTime','End Time') !!}
                        <input type="text" class="form-control" id="endTime" name="endTime">
                    </div>
                    <br>

                    </div>
                </div>

            </div>


            <div class="col-md-5 col-md-offset-1">

                <div class="panel panel-default">
                    <div class="panel-heading"> Additional Details

                    </div>

                    <div class="panel-body">

                    <div class="form-group">
                    {!! Form::label('roomType','Room type') !!}
                        <input type="hidden" class="form-control" id="roomType" name="roomType" value="Good For 2">
                    </div>

                    {!! Form::label('promoType','Promo Type') !!}
                    {!! Form::select('promoType', array('Happy Hour' => 'Happy Hour', 'Regular' => 'Regular'), '',['class'=>'form-control']) !!}
                    <br>

                    <div class="form-group">
                    {!! Form::label('numberOfExtraPerson','Additional Number Of Person') !!}
                        <input type="number" class="form-control" id="numberOfExtraPerson" name="numberOfExtraPerson">
                    </div>
                    <br>

                    <div class="form-group">
                    {!! Form::label('additionalTimeFee','Additional Movie Time Fee') !!}
                        <input type="number" class="form-control" id="additionalTimeFee" name="additionalTimeFee">
                    </div>


                    <div class="form-group">
                    {!! Form::label('corkageFee','Corkage Fee') !!}
                        <input type="number" class="form-control" id="corkageFee" name="corkageFee">
                    </div>


                    <div class="form-group">
                        <input type="hidden" class="form-control" id="session" name="session" value="{{$sessionId}}">
                    </div>

                    <br>
                        <div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            </form>





        </div>
    </div>







@endsection