@extends('layouts.home')
 
@section('content')

    <div class="container">
        <div class="row">

            <form action="{{ url('rooms/'.$id.'/walkinsales') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="col-md-6 col-md-offset-3">

                <div class="panel panel-default">
                    <div class="panel-heading"> Reservation Details

                    </div>

                    <div class="panel-body">
                    <div align="center">
                         Add Customer Details Here
                    </div>
                   
                    <div class="form-group" align="center">
                        <br>
                        <textarea name="movies" cols="50" rows="4" placeholder="Ex. Customer Name , Contact Number ETC"></textarea>
                    </div>
                    <br>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="numberOfMoviesOrHour" value="0" name="numberOfMoviesOrHour">
                    </div>

                    <div class="form-group">
                        {!! Form::label('reservationFee','Reservation Fee') !!}
                        <input type="number" class="form-control" id="reservationFee" value="0" name="reservationFee">
                    </div>

                    <div class="form-group">
                    {!! Form::label('discountFee','Discount') !!}
                        <div style="position: relative">
                            <input class="form-control" type="text" id="discountFee" value="0" name="discountFee"/>
                        </div>
                    </div>
                    <div class="form-group">
                    {!! Form::label('startTime','Start Time') !!}
                        <div style="position: relative">
                            <input class="form-control" type="text" id="startTime" value="{{$startTime}}" name="startTime"/>
                        </div>

                    </div>

                    <div class="form-group">
                    <select id="todayOrTomorrow" name="todayOrTomorrow" class="pull-right"> 
                        <option value="Today">Today</option>
                        <option value="Tomorrow">Tomorrow</option>
                    </select>
                    {!! Form::label('endTime','End Time') !!}
                        <div style="position: relative">
                            <input class="form-control" type="text" id="endTime" value="{{$endTime}}" name="endTime"/>
                        </div>
                    </div>

                    <br>



                        <input type="hidden" class="form-control" id="roomType" name="roomType" value="Reservation">
                        <input type="hidden" name="promoType" id="promoType" value="Reservation">
                        <input type="hidden" class="form-control" id="numberOfExtraPerson" value ="0" name="numberOfExtraPerson">
                        <input type="hidden" class="form-control" id="additionalTimeFee" value ="0" name="additionalTimeFee">
                        <input type="hidden" class="form-control" id="corkageFee" value ="0" name="corkageFee">
                        <input type="hidden" class="form-control" id="session" name="session" value="{{$sessionId}}">
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