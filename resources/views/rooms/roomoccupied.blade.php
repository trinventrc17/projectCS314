@extends('layouts.app')
 
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">What do you want to do?</div>
<br>

        @if($counter!=0)

                <div align="center" >
                        <a href="{{ url('rooms/'.$id.'/roomDetailsAndReceipt') }}"><button type="submit" class="btn btn-primary" style="width:70%">Room Details / New Session</button></a>   
                </div>

                <div class="panel-body">

                    <form action="{{ url('rooms/'.$id.'/walkinsales') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="roomType" name="roomType" value="None">
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="promoType" name="promoType" value="None">
                       </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="startTime" name="startTime" value="None">
                       </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="endTime" name="endTime" value="None">
                       </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="movies" name="movies" value="None">
                       </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="numberOfMoviesOrHour" name="numberOfMoviesOrHour" value="0">
                       </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="numberOfExtraPerson" name="numberOfExtraPerson" value="0">
                       </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="additionalTimeFee" name="additionalTimeFee" value="0">
                       </div>




                        <div>
                            <div align="center" >
                                <button type="submit" class="btn btn-primary" style="width:70%">Add another purchase in this room</button>
                            </div>
                        </div>

                    </form>

                    <br>
     

                    <div align="center" >
                        <a href="{{ url('home') }}"><button type="submit" class="btn btn-primary" style="width:70%">Nothing,Take me back!</button></a>   
                    </div>
                </div>
        @else
 
        <center>
            <strong>Room is occupied but it seems like there is no sales yet , make one now?</strong>
        </center>

                    <form action="{{ url('posrooms/' . $customer->id) }}" method="POST">
                        <input type="hidden" name="_method" value="put">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}">
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status" name="status" value="Occupied">
                       </div>
    
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="session" name="session" value="{{$sessionId}}">
                       </div>

                       <div align="center">
                            <button type="submit" class="btn btn-primary" style="width:70%">Yes, make one now</button>
                       </div>
                    </form>
                    
                    <br>

                    <form action="{{ url('rooms/' . $customer->id) }}" method="POST">
                        <input type="hidden" name="_method" value="put">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="status" name="status" value="Available">
                       </div>
    
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="session" name="session" value="{{$sessionId}}">
                       </div>

                       <div align="center" >
                            <button type="submit" class="btn btn-primary" style="width:70%" >No , End this session</button>
                       </div>
                    </form>
                    <br>

        @endif




            </div>
        </div>
    </div>
</div>




@endsection