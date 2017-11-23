@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="row">

            <form action="{{ url('rooms/'.$id.'/walkinsales') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="col-md-8 col-md-offset-0">

                <div class="panel panel-default">
                    <div class="panel-heading"> Movie Details

                    </div>

                    <div class="panel-body">

                    <div class="form-group">

                    {!! Form::label('promoType','Movie/s') !!}
                        <input type="textarea" class="form-control" id="numberOfExtraPerson" name="numberOfExtraPerson">
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
                        <input type="hidden" class="form-control" id="roomType" name="session" value="Good For 2">
                    </div>

                    {!! Form::label('promoType','Promo Type') !!}
                    {!! Form::select('promoType', array('Happy Hour' => 'Happy Hour', 'Regular' => 'Regular'), '',['class'=>'form-control']) !!}
                    <br>

                    <div class="form-group">
                    {!! Form::label('promoType','Additional Number Of Person') !!}
                        <input type="number" class="form-control" id="numberOfExtraPerson" name="numberOfExtraPerson">
                    </div>
                    <br>

                    <div class="form-group">
                    {!! Form::label('promoType','Additional Movie Time Fee') !!}
                        <input type="number" class="form-control" id="additionalTimeFee" name="additionalTimeFee">
                    </div>


                    <div class="form-group">
                    {!! Form::label('promoType','Corkage Fee') !!}
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