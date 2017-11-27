@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="row">

            <form action="{{ url('rooms/'.$id.'/roomChangesSale') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="col-md-6 col-md-offset-0">

                <div class="panel panel-default">
                    <div class="panel-heading"> Movie / KTV Details

                    </div>

                    <div class="panel-body">

                    @if($roomType == 'Ktv Good For 4' || $roomType == 'Ktv Good For 8')
                        <input type="hidden" class="form-control" id="movies" value="KTV-Sale" name="movies">
                    @else
                    <div align="center">
                         Movie(s) Title here
                    </div>
                   
                    <div class="form-group" align="center">

                    <textarea name="movies" cols="50" rows="4" placeholder="Ex. Angry birds , 50 shades of Grey , Inception"></textarea>


                    </div>
                    @endif
                    <br>
                    
                    <div class="form-group">
                    {!! Form::label('numberOfMoviesOrHour','Number of Movies / Hour') !!}
                        <input type="number" class="form-control" id="numberOfMoviesOrHour" value="0" name="numberOfMoviesOrHour">
                    </div>

                    <div class="form-group">
                    {!! Form::label('startTime','Start Time') !!}
                        <input type="text" class="form-control" id="startTime" value="{{$startTime}}" name="startTime">
                    </div>

                    <div class="form-group">
                    {!! Form::label('endTime','End Time') !!}
                        <input type="text" class="form-control" id="endTime" value="{{$endTime}}" name="endTime">
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
                        <input type="hidden" class="form-control" id="roomType" name="roomType" value="{{$roomType}}">
                    </div>

                    {!! Form::label('promoType','Promo Type') !!}
                    {!! Form::select('promoType', array('Happy Hour' => 'Happy Hour', 'Regular' => 'Regular'), '',['class'=>'form-control']) !!}
                    <br>

                    <div class="form-group">
                    {!! Form::label('numberOfExtraPerson','Additional Number Of Person') !!}
                        <input type="number" class="form-control" id="numberOfExtraPerson" value ="0" name="numberOfExtraPerson">
                    </div>
                    <br>

                    <div class="form-group">
                    {!! Form::label('additionalTimeFee','Additional Movie Time Fee') !!}
                        <input type="number" class="form-control" id="additionalTimeFee" value ="0" name="additionalTimeFee">
                    </div>


                    <div class="form-group">
                    {!! Form::label('corkageFee','Corkage Fee') !!}
                        <input type="number" class="form-control" id="corkageFee" value ="0" name="corkageFee">
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