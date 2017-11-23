@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Room - Edit</div>

                <div class="panel-body">
                    <form action="{{ url('expenses/' . $customer->id) }}" method="POST">
                        <input type="hidden" name="_method" value="put">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}">
                        </div>

                        <div class="form-group">
                        {!! Form::select('status', array('Occupied' => 'Occupied', 'Available' => 'Available' ,'Default' => $customer->status),'Available',['class'=>'form-control']) !!}
                       </div>
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a class="btn btn-link" href="{{ url('posrooms') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection