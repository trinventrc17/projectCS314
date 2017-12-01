@extends('layouts.home')
 
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
                        <input type="number" class="form-control" id="numberOfMoviesOrHour" value="1" name="numberOfMoviesOrHour">
                    </div>

                    <div class="form-group">
                    {!! Form::label('startTime','Start Time') !!}
                        <div style="position: relative">
                            <input class="form-control" type="text" id="startTime" value="{{$startTime}}" name="startTime"/>
                        </div>

                    </div>

                    <div class="form-group">
                    <select id="state" name="todayOrTomorrow" class="pull-right"> 
                        <option value="Today">Today</option>
                        <option value="Tomorrow">Tomorrow</option>
                    </select>
                    {!! Form::label('endTime','End Time') !!}
                        <div style="position: relative">
                            <input class="form-control" type="text" id="endTime" value="{{$endTime}}" name="endTime"/>
                        </div>
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
                        <input type="hidden" class="form-control" id="roomType" name="roomType" value="Movie Good For 8">
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="promoType" name="promoType" value="Regular">
                    </div>

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
                    {!! Form::label('discountFee','Discount Fee') !!}
                        <input type="number" class="form-control" id="discountFee" value ="0" name="discountFee">
                    </div>


                    <div class="form-group">
                        <input type="hidden" class="form-control" id="reservationFee" name="reservationFee" value="0">
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





<script>
    $('#startTime').datetimepicker({
        format: 'HH:mm A'
    });
</script>
<script>
    $('#endTime').datetimepicker({
        format: 'HH:mm A'
    });
</script>



@endsection