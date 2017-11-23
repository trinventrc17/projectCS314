@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Do you want to occupy this room?</div>

                <div class="panel-body">
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
                            <button type="submit" class="btn btn-primary" style="width:70%">Yes, occupy room</button>
                       </div>
                    </form>
                    <br>
                    <div align="center" >
                        <a href="{{ url('home') }}"><button type="submit" class="btn btn-primary" style="width:70%">Nope,Take me back!</button></a>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection