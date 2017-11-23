@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Room - Create</div>

                <div class="panel-body">
                    <form action="{{ url('posrooms') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                        {!! Form::select('status', array('Occupied' => 'Occupied', 'Available' => 'Available'),'Available',['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="session" name="session" value="0">
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-link" href="{{ url('posrooms') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection