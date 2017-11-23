@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Stocks - Create</div>

                <div class="panel-body">
                    <form action="{{ url('stocks') }}" method="POST">
                        {{ csrf_field() }}


                        {!! Form::label('name','Product Name') !!}
                        {!! Form::select('name', $products, '',['class'=>'form-control']) !!}     


                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="quantity" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
                        </div>
                  
                  <br>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-link" href="{{ url('products') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection