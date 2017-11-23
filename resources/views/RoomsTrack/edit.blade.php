
@extends('layouts.app')
 
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Room</div>

                    <div class="panel-body">

                        {!! Form::model($item,array('route'=>['RoomsTrack.update',$item->id],'method'=>'PUT')) !!}
                            <div class="form-group">
                                {!! Form::label('name','Room Name') !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('status','Status') !!}
                                {!! Form::select('status', array('Occupied' => 'Occupied', 'Available' => 'Available'), '',['class'=>'form-control']) !!}

                            </div>
                            <div class="form-group">
                                {!! Form::button('Update',['type'=>'submit','class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>

            </div>
        </div>
    </div>





@endsection




